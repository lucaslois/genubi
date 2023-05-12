<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = User::all();

        return response()->json($characters);
    }
}
