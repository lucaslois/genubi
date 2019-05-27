<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            $request->avatar->storeAs('public/characters', $name);

            $character->avatar = Storage::url("public/characters/$name");
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
            $request->avatar->storeAs('public/characters', $name);

            $character->avatar = Storage::url("public/characters/$name");
            $character->save();
        }

        Alert::send('El personaje se ha actualizado correctamente');

        return redirect()->route('characters.me', $character->id);
    }

    public function show($id) {
        $character = Character::findOrFail($id);

        return view('pages.characters.show', compact('character'));
    }
}
