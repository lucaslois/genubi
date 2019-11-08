<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Campaign;
use App\Models\Knowledge;
use App\Models\KnowledgeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KnowledgeController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $selected_campaign = Campaign::findOrFail($request->campaign_id);

        if($user)
            $query = $user->knowledgesOf($selected_campaign);
        else
            $query = Knowledge::whereShareEveryone(true);

        if($user) {
            switch ($request->visibility) {
                case "me":
                    $query->where('knowledges.user_id', $user->id);
                    break;
                case "shared":
                    $list_of_characters = $user->characters->pluck('id');
                    $query->where(function ($query) use ($list_of_characters) {
                        $query->orWhereIn('knowledge_character.character_id', $list_of_characters)
                            ->orWhere('knowledges.share_everyone', true);
                    })
                        ->where('is_official', false);
                    break;
                case "dm":
                    $query->where('is_official', true);
                    break;
            }
        }

        if($request->type) {
            $type = KnowledgeType::whereSlug($request->type)->firstOrFail();
            $query->where('knowledges.type_id', $type->id);
        }

        $knowledges = $query->paginate(10);

        return view('pages.knowledges.index', compact('selected_campaign', 'knowledges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $selected_campaign = Campaign::findOrFail($request->campaign_id);
        $characters = $user->characters()->whereCampaignId($selected_campaign->id)->get();
        $shared_with = $selected_campaign->activeCharacters();

        $types = KnowledgeType::all();

        return view('pages.knowledges.create', compact( 'selected_campaign', 'shared_with', 'characters', 'types'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:3',
            'text' => 'required|min:3'
        ]);
        $user = Auth::user();
        $knowledge = new Knowledge;
        $knowledge->fill($request->all());
        $knowledge->user()->associate($user);
        $knowledge->share_everyone = $request->has('share_everyone');
        $knowledge->save();

        $knowledge->characters()->sync($request->character_ids);

        $knowledge->notifyAllUsers();

        Alert::send('El conocimiento se ha creado correctamente');

        return redirect()->route('knowledges.show', $knowledge->id);
    }

    public function show($id) {
        $user = Auth::user();
        $knowledge = Knowledge::findOrFail($id);
        $selected_campaign = $knowledge->campaign;

        if($user->knowledgesOf($selected_campaign)->get()->contains($knowledge) == false)
            abort(403);

        return view('pages.knowledges.show', compact('selected_campaign', 'knowledge'));
    }

    public function edit($id) {
        $user = Auth::user();
        $knowledge = $user->knowledges()->findOrFail($id);
        $selected_campaign = $knowledge->campaign;
        $characters = $user->characters()->whereCampaignId($selected_campaign->id)->get();
        $shared_with = $selected_campaign->activeCharacters();

        $types = KnowledgeType::all();

        return view('pages.knowledges.edit', compact( 'knowledge', 'selected_campaign', 'shared_with', 'characters', 'types'));
    }

    public function update($id, Request $request) {
        $user = Auth::user();
        $knowledge = Knowledge::findOrFail($id);
        $knowledge->fill($request->all());
        $knowledge->user()->associate($user);
        $knowledge->share_everyone = $request->has('share_everyone');
        $knowledge->save();

        $knowledge->notifyAllUsers();

        $knowledge->characters()->sync($request->character_ids);

        Alert::send('El conocimiento se ha guardado correctamente');

        return redirect()->route('knowledges.show', $knowledge->id);
    }
}
