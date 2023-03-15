<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Mail\RegisterConfirmationMail;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index() {
        return view('pages.register.index');
    }

    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if(User::whereEmail($request->email)->count() > 0)
            return back()->withInput()->withErrors(['email' => 'El correo electrónico ya existe']);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = Str::random(10);
        $user->tokens()->create([
            'token' => $token
        ]);

        Mail::to($user)->send(new RegisterConfirmationMail($user, $token));

        Alert::send("Hemos enviado un correo electrónico a $user->email para validar tu cuenta.");

        return redirect()->route('login.index');
    }

    public function check($token) {
        $token = UserToken::whereToken($token)->first();

        abort_if($token == null, 404, 'El token ingresado no se ha encontrado en el sistema');
        abort_if($token->used_at, 404, 'El token ingresado ya fue utilizado');

        $user = $token->user;
        $user->email_verified_at = now();
        $user->save();

        $token->used_at = now();
        $token->save();

        Alert::send('El correo electrónico se ha validado correctamente. ¡Bienvenido!');

        Auth::login($user);

        return redirect()->route('index');
    }
}
