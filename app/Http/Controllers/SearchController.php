<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        $query = Tag::query();

        $query->where('tag', 'LIKE', "%$request->global_search%");
        $query->where('active', true);

        $tags = $query->paginate(20);

        if($tags->count() == 1) {
            $tag = $tags->first();
            $item = $tag->taggable;

            return redirect()->to($item->formattedLink());
        }

        return view('pages.search.index', compact('tags'));
    }
}
