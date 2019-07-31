<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Activity;
use App\Models\Campaign;
use App\Models\Character;
use App\Models\Notification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CharacterClass;
use App\Models\CharacterState;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    public function me(Request $request) {
        $user = Auth::user();
        $query = $user->characters();

        if($request->search)
            $query->where('name', 'LIKE', "%$request->search%");

        $characters = $query->get();

        return view('pages.characters.me', compact('characters'));
    }

    public function create(Request $request) {
        $campaign_to_join = Campaign::whereToken($request->join_link)->first();
        return view('pages.characters.create', compact('campaign_to_join'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'avatar' => 'file|mimes:jpg,jpeg,png',
            'description' => 'string'
        ]);
        $user = Auth::user();

        $character = new Character;
        $character->fill($request->all());
        $character->user_id = $user->id;
        $character->state_id = 1;
        $character->slug = $character->generateSlug();
        $character->save();

        $campaign_to_join = Campaign::whereToken($request->join_link)->first();
        if($campaign_to_join) {
            $character->campaign()->associate($campaign_to_join);
            $character->save();

            Notification::create([
                'user_id' => $campaign_to_join->user->id,
                'text' => "{$user->name} ha ingresado en {$campaign_to_join->name} como $character->name usando un link de acceso",
                'image' => $character->getImage(),
                'link' => route('campaigns.show', $campaign_to_join->id)
            ]);
        }

        if($request->avatar) {
            $ext = $request->avatar->getClientOriginalExtension();
            $name = Str::slug($character->name) . "_" . time() . "." . $ext;
            $img = Image::make($request->avatar);
            $img->fit(300);
            $path = "public/characters/$name";
            Storage::put($path, $img->stream());

            $character->avatar = Storage::url($path);
            $character->save();
        }

        Activity::send($user, "<b>$user->name</b> ha creado al personaje <b>$character->name</b>");
        Alert::send('El personaje se ha creado correctamente');

        return redirect()->route('characters.me', $character->id);
    }

    public function edit($id, Request $request) {
        $user = Auth::user();
        $character = Character::findOrFail($id);

        if($character->user->isNot($user))
            abort(401);

        return view('pages.characters.edit', compact('character'));
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'avatar' => 'file|mimes:jpg,jpeg,png|',
            'description' => 'string'
        ]);

        $character = Character::findOrFail($id);
        $user = Auth::user();

        if($character->user->isNot($user))
            abort(401);

        $character->fill($request->all());
        $character->save();

        if($request->avatar) {
            $ext = $request->avatar->getClientOriginalExtension();
            $name = Str::slug($character->name) . "_" . time() . "." . $ext;
            $img = Image::make($request->avatar);
            $img->fit(300);
            $path = "public/characters/$name";
            Storage::put($path, $img->stream());

            $character->avatar = Storage::url($path);
            $character->save();
        }

        Alert::send('El personaje se ha actualizado correctamente');

        return redirect()->route('characters.show', $character->id);
    }

    public function show($id) {
        $character = Character::findOrFail($id);

        return view('pages.characters.show', compact('character'));
    }

    public function addClass($id, Request $request) {
        $this->validate($request, [
            'class' => 'required|string',
            'level' => 'required|numeric'
        ]);
        $user = Auth::user();
        $character = $user->characters()->findOrFail($id);
        $user = Auth::user();

        if($character->user->isNot($user))
            abort(401);

        $class = new CharacterClass;
        $class->name = $request->class;
        $class->level = $request->level;
        $class->character_id = $character->id;
        $class->save();

        Alert::send("Se ha añadido la clase $class->name al personaje");

        return back();
    }

    public function removeClass($id, $class_id)
    {
        $user = Auth::user();
        $character = $user->characters()->findOrFail($id);

        $character->classes()->find($class_id)->delete();

        return back();
    }

    public function editDm($id) {
        $character = Character::findOrFail($id);
        $states = CharacterState::all();
        $user = Auth::user();

        if($character->campaign->user->isNot($user))
            abort(401);

        return view('pages.characters.edit_dm', compact('character', 'states'));
    }

    public function updateDm($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'avatar' => 'file|mimes:jpg,jpeg,png',
            'description' => 'string'
        ]);

        $character = Character::findOrFail($id);
        $user = Auth::user();

        if($character->campaign->user->isNot($user))
            abort(401);

        $character->fill($request->all());
        $character->save();

        if($request->avatar) {
            $ext = $request->avatar->getClientOriginalExtension();
            $name = Str::slug($character->name) . "_" . time() . "." . $ext;
            $img = Image::make($request->avatar);
            $img->fit(300);
            $path = "public/characters/$name";
            Storage::put($path, $img->stream());

            $character->avatar = Storage::url($path);
            $character->save();
        }

        Alert::send('El personaje se ha actualizado correctamente');

        return redirect()->route('campaigns.show', $character->campaign->id);
    }
}
