<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Activity;
use App\Models\Campaign;
use App\Models\Character;
use App\Models\CharacterExperience;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function panel($id) {
        $user = Auth::user();
        $selected_campaign = Campaign::findOrFail($id);
        abort_if($selected_campaign->user->isNot($user), 401);

        $last_sessions = $selected_campaign->sessions->take(7);
        $characters = $selected_campaign->activeCharacters();

        return view('pages.campaigns.experiences_panel', compact('selected_campaign', 'last_sessions', 'characters'));
    }

    public function index($id) {
        $user = Auth::user();
        $selected_campaign = Campaign::findOrFail($id);
        abort_if($selected_campaign->user->isNot($user), 401);

        return view('pages.campaigns.experiences', compact('selected_campaign'));
    }

    public function store($id, Request $request) {
        $user = Auth::user();
        $selected_campaign = $user->campaigns()->findOrFail($id);

        $characters = Character::findOrFail($request->character_ids);
        $counter = 0;
        foreach($characters as $character) {
            if(!$request->value[$character->id])
                continue;
            $counter++;
            CharacterExperience::create([
                'user_id' => $user->id,
                'character_id' => $character->id,
                'value' => $request->value[$character->id],
                'reason' => $request->reason[$character->id],
                'session_id' => $request->session_id
            ]);

            Notification::create([
                'user_id' => $character->user->id,
                'text' => "{$user->name} le ha dado experiencia a {$character->name} en {$character->campaign->name}",
                'image' => $character->getImage(),
                'link' => route('characters.show', $character->id)
            ]);
        }

        Alert::send("La experiencia se ha entregado correctamente a {$counter} personajes");
        Activity::send($user, "<b>$user->name</b> ha repartido experiencias en la campaña <b>$selected_campaign->name</b>");


        return redirect()->route('campaigns.show', $selected_campaign->id);
    }
}
