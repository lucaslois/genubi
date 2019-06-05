<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id) {
        $user = User::findOrFail($id);

        return view('pages.users.show', compact('user'));
    }
}
