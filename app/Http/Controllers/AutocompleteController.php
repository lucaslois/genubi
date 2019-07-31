<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterResource;
use App\Models\Autocomplete;
use App\Models\Character;
use App\Models\Npc;
use App\Models\SessionPost;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function index(Request $request) {
        $characters = Character::where('slug', 'LIKE', "%$request->search%")->get();
        $npcs = Npc::where('slug', 'LIKE', "%$request->search%")->get();

        $result = $characters->merge($npcs);

        return response()->json(['characters' => CharacterResource::collection($result)]);
    }
}
