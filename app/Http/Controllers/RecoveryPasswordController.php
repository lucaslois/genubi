<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Mail\ForgotPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RecoveryPasswordController extends Controller
{
    public function index($token) {
        $password_reset = PasswordReset::whereToken($token)->firstOrFail();
        return view('pages.login.recovery_password', compact('password_reset'));
    }

    public function store($token, Request $request) {
        $this->validate($request, [
            'password' => 'required|string|min:8'
        ]);

        $password_reset = PasswordReset::whereToken($token)->firstOrFail();
        $user = $password_reset->user();
        $user->password = Hash::make($request->password);
        $user->save();
        $password_reset->delete();

        Alert::send('La contraseña se ha cambiado correctamente');

        return redirect()->route('login.index');
    }
}
