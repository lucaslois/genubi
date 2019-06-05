<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function edit() {
        $user = Auth::user();

        return view('pages.profile.edit');
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'avatar' => 'file|mimes:jpg,jpeg,png'
        ]);

        $user = Auth::user();
        $user->fill($request->all());

        if($request->avatar) {
            $ext = $request->avatar->getClientOriginalExtension();
            $name = Str::slug($user->name) . "_" . time() . "." . $ext;
            $img = Image::make($request->avatar);
            $img->fit(200);
            $path = "public/users/$name";
            Storage::put($path, $img->stream());

            $user->avatar = Storage::url($path);
        }
        $user->save();

        Alert::send('Tu perfil se ha guardado correctamente');

        return redirect()->route('users.show', $user->id);
    }
}
