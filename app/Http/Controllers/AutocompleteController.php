<?php

namespace App\Http\Controllers;

use App\Models\Autocomplete;
use App\Models\SessionPost;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function index(Request $request) {

        $post = SessionPost::find(62);
        $formatted = Autocomplete::format($post->text);

        //return response()->json(['words' => '']);
    }
}
