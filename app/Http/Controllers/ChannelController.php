<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Campaign;
use App\Models\Channel;
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

        Alert::send('El canal se ha creado correctamente');

        return redirect()->route('campaigns.channels.index', compact('campaign'));
    }

    public function show($id) {
        $channel = Channel::findOrFail($id);
        $selected_campaign = $channel->campaign;
        $posts = $channel->posts()->paginate(10);

        return view('pages.channels.show', compact('channel', 'selected_campaign', 'posts'));
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
}
