<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('pages.profile.password');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = Auth::user();

        if(!Hash::check($request->old_password, $user->password))
            return back()->withInput()->withErrors(['old_password' => 'La contraseña es incorrecta']);

        $user->password = Hash::make($request->password);
        $user->save();

        Alert::send('Tu contraseña se ha cambiado exitosamente');

        return redirect()->route('index');
    }
}
