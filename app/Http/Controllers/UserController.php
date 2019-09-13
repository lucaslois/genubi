<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {
        $query = User::query();

        if($request->search)
            $query->where('name', 'LIKE', "%$request->search%");

        $users = $query->paginate(20);
        return view('pages.users.index', compact('users'));
    }

    public function show($id) {
        $user = User::findOrFail($id);

        return view('pages.users.show', compact('user'));
    }
}
