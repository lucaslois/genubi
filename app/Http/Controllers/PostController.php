<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Channel;
use App\Models\ChannelPost;
use App\Models\Dices\TiradaDado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create($id, Request $request) {
        $user = Auth::user();
        $channel = Channel::findOrFail($id);
        $selected_campaign = $channel->campaign;

        $characters = $user->characters()->whereCampaignId($selected_campaign->id)->get();
        $npcs = $selected_campaign->npcs;

        $post = $channel->posts()->find($request->post_id);
        $last_post = $channel->posts->last();

        return view('pages.channels.create_post', compact('channel', 'selected_campaign', 'characters', 'npcs', 'post', 'last_post'));
    }

    public function store($id, Request $request) {
        $this->validate($request, [
            'character_id' => 'required',
            'text' => 'required'
        ]);

        $letter = substr($request->character_id, 0, 1);
        $charid = substr($request->character_id, 1);

        $user = Auth::user();
        $channel = Channel::findOrFail($id);

        $post = new ChannelPost;
        $post->fill($request->all());
        $post->user_id = $user->id;
        $post->channel_id = $id;
        if($letter === 'N')
            $post->npc_id = $charid;
        if($letter === 'C')
            $post->character_id = $charid;

        $post->save();

        $channel->order = Channel::getLastOrder()->order + 1;
        $channel->save();

        Alert::send('El post se ha enviado correctamente');

        return redirect()->route('channels.show', $channel->id);
    }

    public function edit($id) {
        $user = Auth::user();
        $post = ChannelPost::findOrFail($id);
        $selected_campaign = $post->channel->campaign;
        $channel = $post->channel;
        $characters = $user->characters()->whereCampaignId($selected_campaign->id)->get();
        $npcs = $selected_campaign->npcs;

        return view('pages.channels.edit_post', compact('post', 'selected_campaign', 'channel','characters', 'npcs'));
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'character_id' => 'required',
            'text' => 'required'
        ]);

        $letter = substr($request->character_id, 0, 1);
        $charid = substr($request->character_id, 1);

        $post = ChannelPost::findOrFail($id);
        $post->fill($request->all());
        $post->npc_id = null;
        $post->character_id = null;
        if($letter === 'N')
            $post->npc_id = $charid;
        if($letter === 'C')
            $post->character_id = $charid;

        $channel = $post->channel;

        $post->save();

        Alert::send('El post se ha guardado correctamente');

        return redirect()->route('channels.show', $channel->id);
    }

    public function createDices($id) {
        $user = Auth::user();
        $channel = Channel::findOrFail($id);
        $selected_campaign = $channel->campaign;

        $characters = $user->characters()->whereCampaignId($selected_campaign->id)->get();
        $npcs = $selected_campaign->npcs;

        return view('pages.channels.roll_dices', compact('channel', 'selected_campaign', 'characters', 'npcs'));
    }

    public function storeDices($id, Request $request) {
        $this->validate($request, [
            'character_id' => 'required',
            'roll' => 'required',
            'reason' => 'required'
        ]);

        $letter = substr($request->character_id, 0, 1);
        $charid = substr($request->character_id, 1);

        $user = Auth::user();
        $channel = Channel::findOrFail($id);

        $post = new ChannelPost;
        $post->fill($request->all());
        $post->user_id = $user->id;
        $post->channel_id = $id;
        $post->is_roll = true;
        if($letter === 'N')
            $post->npc_id = $charid;
        if($letter === 'C')
            $post->character_id = $charid;

        try {
            $roll = new TiradaDado($request->roll);
            $res = $roll->getTira();
            $post->text = "<div class='post-roll'><span class='roll'>Motivo</span>: $request->reason<br><span class='roll'>Tirada de dados</span>: $request->roll<br><span class='roll'>Resultado</span>: $res</div>";
        }
        catch(\Exception $e) {
            return back()->withInput()->withErrors(['roll' => 'No se ha podido procesar la tirada de dados. Revisa la sintaxis']);
        }

        $post->save();

        Alert::send('La tirada de dados se ha enviado correctamente');

        return redirect()->route('channels.show', $channel->id);
    }

}
