<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterResource;
use App\Http\Resources\TagResource;
use App\Models\Autocomplete;
use App\Models\Character;
use App\Models\Npc;
use App\Models\SessionPost;
use App\Models\Tag;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function index(Request $request) {
        $query = Tag::query();
        $query->where('tag', 'LIKE', "%$request->search%");
        $query->where('active', true);
        $query->limit(10);

        $result = $query->get();

        return response()->json(['tags' => TagResource::collection($result)]);
    }
}
