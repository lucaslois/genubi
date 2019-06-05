<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Activity;
use App\Models\Session;
use App\Models\SessionVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function positive($id) {
        $session = Session::findOrFail($id);
        $user = Auth::user();

        SessionVote::updateOrCreate([
            'user_id' => $user->id,
            'session_id' => $session->id
        ], [
            'vote' => 1
        ]);

        Alert::send('Gracias por enviar tu voto :)');
        Activity::send($user, "<b>$user->name</b> ha dado <b>me gusta</b> a la sesión <b>$session->name</b>");

        return redirect()->route('sessions.show', $session->id);
    }

    public function negative($id) {
        $session = Session::findOrFail($id);
        $user = Auth::user();

        SessionVote::updateOrCreate([
            'user_id' => $user->id,
            'session_id' => $session->id
        ], [
            'vote' => -1
        ]);

        Alert::send('Gracias por enviar tu voto :)');
        Activity::send($user, "<b>$user->name</b> ha dado <b>no me gusta</b> a la sesión <b>$session->name</b>");

        return redirect()->route('sessions.show', $session->id);
    }
}
