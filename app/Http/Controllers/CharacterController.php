<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Character;
use App\Models\CharacterClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CharacterController extends Controller
{
    public function me() {
        $user = Auth::user();
        $characters = $user->characters;

        return view('pages.characters.me', compact('characters'));
    }

    public function create() {
        return view('pages.characters.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'avatar' => 'file|mimes:jpg,jpeg,png',
            'description' => 'string|max:100'
        ]);

        $character = new Character;
        $character->fill($request->all());
        $character->user_id = 1;
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

        Alert::send('El personaje se ha creado correctamente');

        return redirect()->route('characters.me', $character->id);
    }

    public function edit($id, Request $request) {
        $character = Character::findOrFail($id);

        return view('pages.characters.edit', compact('character'));
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'avatar' => 'file|mimes:jpg,jpeg,png',
            'description' => 'string|max:100'
        ]);

        $character = Character::findOrFail($id);
        $character->fill($request->all());
        $character->user_id = 1;
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
        $user = Auth::user();
        $character = $user->characters()->findOrFail($id);

        $class = new CharacterClass;
        $class->name = $request->name;
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
}
