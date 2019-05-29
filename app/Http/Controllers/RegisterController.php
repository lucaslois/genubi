<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Mail\RegisterConfirmationMail;
use App\Models\User;
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

        Cache::put($token, $user->id, 1);

        Mail::to($user)->send(new RegisterConfirmationMail($user, $token));

        Alert::send("Hemos enviado un correo electrónico a $user->email para validar tu cuenta.");

        return redirect()->route('login.index');
    }

    public function check($token) {
        if(Cache::has($token) === false)
            abort(404);

        $id = Cache::get($token);

        $user = User::findOrFail($id);
        $user->email_verified_at = now();
        $user->save();

        Alert::send('El correo electrónico se ha validado correctamente. ¡Bienvenido!');

        Auth::login($user);

        Cache::forget($token);

        return redirect()->route('index');
    }
}
