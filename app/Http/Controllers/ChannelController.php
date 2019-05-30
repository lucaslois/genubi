<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Campaign;
use App\Models\Channel;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    public function index($id) {
        $selected_campaign = Campaign::findOrFail($id);
        $channels = $selected_campaign->channels()->paginate(10);

        return view('pages.channels.index', compact('channels', 'selected_campaign'));
    }

    public function create() {
        $user = Auth::user();
        $campaigns = $user->campaigns;

        return view('pages.channels.create', compact('campaigns'));
    }

    public function store(Request $request) {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|min:3',
            'text' => 'required|min:3',
        ]);
        $channel = new Channel;
        $channel->fill($request->all());
        $channel->user_id = $user->id;
        $channel->save();
        $campaign = $channel->campaign;
        $channel->characters()->sync($request->character_ids);

        Alert::send('El canal se ha creado correctamente');

        foreach($campaign->usersPlaying() as $participant) {
            if($user->is($participant))
                continue;
            Notification::create([
                'user_id' => $participant->id,
                'text' => "{$user->name} ha creado el canal {$channel->name} en {$campaign->name}",
                'image' => $user->getImage(),
                'link' => route('channels.show', $channel->id)
            ]);
        }

        return redirect()->route('channels.show', $channel->id);
    }

    public function show($id) {
        $channel = Channel::findOrFail($id);
        $selected_campaign = $channel->campaign;
        $posts = $channel->posts()->paginate(10);

        return view('pages.channels.show', compact('channel', 'selected_campaign', 'posts'));
    }

    public function edit($id) {
        $user = Auth::user();
        $channel = Channel::findOrFail($id);
        $selected_campaign = $channel->campaign;

        return view('pages.channels.edit', compact('channel', 'selected_campaign'));
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|min:3',
            'text' => 'required|min:3',
        ]);
        $channel = Channel::findOrFail($id);
        $channel->fill($request->all());
        $channel->save();
        $campaign = $channel->campaign;
        $channel->characters()->sync($request->character_ids);

        Alert::send('El canal se ha creado correctamente');

        return redirect()->route('channels.show', $channel->id);
    }

    public function lastPost($id) {
        $channel = Channel::findOrFail($id);

        $last_post = $channel->posts->last();

        return response()->json([
            'id' => $last_post->id,
            'user' => $last_post->user->name,
            'participant' => $last_post->participant()->getName()
        ]);
    }

    public function suscribe($id) {
        $user = Auth::user();
        $channel = Channel::findOrFail($id);
        $channel->suscribedUsers()->attach($user->id);

        Alert::send("Te has suscrito correctamente a $channel->name correctamente");

        return back();
    }

    public function unsuscribe($id) {
        $user = Auth::user();
        $channel = Channel::findOrFail($id);
        $channel->suscribedUsers()->detach($user->id);

        Alert::send("Te has desuscrito correctamente a $channel->name correctamente");

        return back();
    }

    public function open($id) {
        $user = Auth::user();
        $channel = Channel::findOrFail($id);
        abort_if($channel->campaign->user->isNot($user),404);
        $channel->closed = false;
        $channel->save();

        Alert::send("El canal $channel->name ha sido abierto");

        return back();
    }

    public function close($id) {
        $user = Auth::user();
        $channel = Channel::findOrFail($id);
        abort_if($channel->campaign->user->isNot($user),404);
        $channel->closed = true;
        $channel->save();

        Alert::send("El canal $channel->name ha sido cerrado");

        return back();
    }
}
