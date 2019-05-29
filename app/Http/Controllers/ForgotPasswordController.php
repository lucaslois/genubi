<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Mail\ForgotPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index() {
        return view('pages.login.forgot_password');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required|string|email'
        ]);

        $user = User::whereEmail($request->email)->first();
        if(is_null($user))
            return back()->withInput()->withErrors(['email' => 'No existe el correo electrónico en el sistema']);

        $token = PasswordReset::updateOrCreate([
            'email' =>  $request->email,
        ], [
            'token' => Str::random(20)
        ]);

        Alert::send('Hemos enviado un enlace de recuperación a tu correo electrónico');

        Mail::to($request->email)->send(new ForgotPasswordMail($user, $token));

        return redirect()->route('login.index');
    }
}
