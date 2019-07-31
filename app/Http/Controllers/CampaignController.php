<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Game;
use App\Models\Mode;
use App\Facades\Alert;
use App\Models\Campaign;
use App\Models\Character;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\CampaignState;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index(Request $request) {
        $query = Campaign::query();

        if($request->search)
            $query->where("name", "LIKE", "%$request->search%");

        $campaigns = $query->get();

        return view('pages.campaigns.index', compact('campaigns'));
    }

    public function show($id) {
        $campaign = Campaign::findOrFail($id);
        $selected_campaign = $campaign;

        $characters = $campaign->activeCharacters();

        return view('pages.campaigns.show', compact('campaign', 'selected_campaign', 'characters'));
    }

    public function create() {
        $games = Game::all();
        $modes = Mode::all();
        return view('pages.campaigns.create', compact('games', 'modes'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'required|min:15',
            'background_image' => 'file|mimes:jpeg,jpg,png'
        ]);

        $user = Auth::user();

        $campaign = new Campaign;
        $campaign->fill($request->all());
        $campaign->user_id = $user->id;
        $campaign->state_id = CampaignState::whereSlug('active')->first()->id;
        $campaign->score = 0;
        $campaign->save();

        if($request->background_image) {
            $ext = $request->background_image->getClientOriginalExtension();
            $name = Str::slug($campaign->name) . "_" . time() . "." . $ext;
            $name_mini = Str::slug($campaign->name) . "_mini_" . time() . "." . $ext;
            $request->background_image->storeAs('public/campaigns', $name);

            $campaign->background_image = Storage::url("public/campaigns/$name");
            $img = Image::make($request->background_image);
            $img->fit(350, 200);
            $path = "public/campaigns/$name_mini";
            Storage::put($path, $img->stream());

            $campaign->background_image_mini = Storage::url($path);
            $campaign->save();
        }

        Activity::send($user, "<b>$user->name</b> ha creado la campaña <b>$campaign->name.</b>");

        Alert::send('La campaña se ha creado correctamente');

        return redirect()->route('campaigns.index');
    }

    public function edit($id) {
        $user = Auth::user();
        $campaign = Campaign::findOrFail($id);
        $games = Game::all();
        $modes = Mode::all();
        $states = CampaignState::all();

        abort_if($campaign->user->isNot($user), 401);

        return view('pages.campaigns.edit', compact('campaign', 'games', 'modes', 'states'));
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'required|min:15',
            'background_image' => 'file|mimes:jpeg,jpg,png'
        ]);

        $user = Auth::user();
        $campaign = Campaign::findOrFail($id);
        abort_if($campaign->user->isNot($user), 401);
        $campaign->fill($request->all());
        $campaign->save();

        if($request->background_image) {
            $ext = $request->background_image->getClientOriginalExtension();
            $name = Str::slug($campaign->name) . "_" . time() . "." . $ext;
            $name_mini = Str::slug($campaign->name) . "_mini_" . time() . "." . $ext;
            $request->background_image->storeAs('public/campaigns', $name);

            $campaign->background_image = Storage::url("public/campaigns/$name");

            $img = Image::make($request->background_image);
            $img->fit(350, 200);
            $path = "public/campaigns/$name_mini";
            Storage::put($path, $img->stream());

            $campaign->background_image_mini = Storage::url($path);
            $campaign->save();
        }

        Alert::send('La campaña se ha actualizado correctamente');

        return redirect()->route('campaigns.show', $campaign->id);
    }

    public function remove($id) {
        $user = Auth::user();
        $campaign = $user->campaigns()->findOrFail($id);

        $campaign->delete();

        Alert::send("La campaña se ha eliminado correctamente");
        Activity::send($user, "<b>$user->name</b> ha eliminado la campaña <b>$campaign->name</b>");

        return redirect()->route('campaigns.me');
    }

    public function me(Request $request) {
        $user = Auth::user();
        $query = $user->campaigns();

        if($request->search)
            $query->where('name', 'LIKE', "%$request->search%");

        $campaigns = $query->get();

        return view('pages.campaigns.me', compact('campaigns'));
    }

    public function joinIndex($token) {
        $user = Auth::user();
        abort_if(!$user, 401);

        $campaign = Campaign::whereToken($token)->first();
        abort_if(is_null($campaign), 404);

        $characters = $user->characters()->whereNull('campaign_id')->get();
        return view('pages.campaigns.join', compact('campaign', 'characters'));
    }

    public function joinStore($token, Request $request) {
        $user = Auth::user();
        if(!$user)
            abort(401);
        $campaign = Campaign::whereToken($token)->first();
        abort_if(is_null($campaign), 404);

        $character = Character::findOrFail($request->character_id);
        $character->campaign_id = $campaign->id;
        $character->save();

        Alert::send("Has ingresado en $campaign->name. Bienvenido, aventurero.");

        Notification::create([
            'user_id' => $campaign->user->id,
            'text' => "{$user->name} ha ingresado en {$campaign->name} como $character->name usando un link de acceso",
            'image' => $character->getImage(),
            'link' => route('campaigns.show', $campaign->id)
        ]);

        Activity::send($user, "<b>$user->name</b> ha entrado a la campaña <b>$campaign->name</b> con <b>{{ $character->name}}</b>");


        return redirect()->route('campaigns.show', $campaign->id);
    }

    public function linkIndex($id) {
        $user = Auth::user();
        $campaign = Campaign::findOrFail($id);
        abort_if($campaign->user->isNot($user), 401);

        return view('pages.campaigns.create_link', compact('campaign'));
    }

    public function linkRegenerate($id) {
        $campaign = Campaign::findOrFail($id);
        $campaign->token = Str::random('10');
        $campaign->save();

        return redirect()->route('campaigns.link.index', $campaign->id);
    }

    public function linkDisable($id) {
        $campaign = Campaign::findOrFail($id);
        $campaign->token = null;
        $campaign->save();

        return redirect()->route('campaigns.link.index', $campaign->id);
    }
}
