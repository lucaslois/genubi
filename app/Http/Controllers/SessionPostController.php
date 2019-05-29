<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Session;
use App\Models\SessionPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionPostController extends Controller
{
    public function create($id) {
        $session = Session::findOrFail($id);
        $selected_campaign = $session->campaign;
        $user = Auth::user();
        $characters = $user->characters()->whereCampaignId($selected_campaign->id)->get();

        return view('pages.sessions.create_post', compact('session', 'selected_campaign', 'characters'));
    }

    public function store($id, Request $request) {
        $this->validate($request, [
            'character_id' => 'required',
            'text' => 'required'
        ]);
        $session = Session::findOrFail($id);
        $selected_campaign = $session->campaign;
        $user = Auth::user();

        $post = SessionPost::create([
            'user_id' => $user->id,
            'session_id' => $session->id,
            'character_id' => $request->character_id,
            'text' => $request->text
        ]);

        Alert::send('El post se ha guardado correctamente');

        return redirect()->route('sessions.show', $session->id);
    }

    public function edit($id) {
        $post = SessionPost::findOrFail($id);
        $selected_campaign = $post->session->campaign;

        return view('pages.sessions.edit_post', compact('post', 'selected_campaign'));
    }

    public function update($id, Request $request) {
        $user = Auth::user();
        $post = $user->sessionPosts()->findOrFail($id);
        $post->text = $request->text;
        $post->save();

        Alert::send('El post se ha guardado correctamente');

        return redirect()->route('sessions.show', $post->session->id);
    }
}
