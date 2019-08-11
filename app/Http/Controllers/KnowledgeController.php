<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Campaign;
use App\Models\Knowledge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KnowledgeController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $selected_campaign = Campaign::findOrFail($request->campaign_id);

        $query = $user->knowledgesOf($selected_campaign);

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

        return view('pages.knowledges.create', compact( 'selected_campaign', 'shared_with', 'characters'));
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

        return view('pages.knowledges.edit', compact( 'knowledge', 'selected_campaign', 'shared_with', 'characters'));
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
