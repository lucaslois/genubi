<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        return view('pages.login.index');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if(is_null($user))
            return back()->withInput()->withErrors(['email' => 'El correo electrónico no existe']);
        if(Hash::check($request->password, $user->password) == false)
            return back()->withInput()->withErrors(['password' => 'La contraseña no es correcta']);
        if(is_null($user->email_verified_at))
            return back()->withInput()->withErrors(['email' => 'El correo electrónico no fue validado. ¡Revisa tu email!']);

        Auth::login($user);

        Alert::send("Bienvenido de nuevo, $user->name");

        return redirect()->route('index');
    }

    public function forgotPassword(Request $request) {

    }

    public function logout() {
        Auth::logout();

        return redirect()->route('index');
    }
}
