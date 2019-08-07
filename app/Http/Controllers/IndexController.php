<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Campaign;
use App\Models\Session;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $campaigns = Campaign::orderByDesc('score')->get()->take(3);
        $sessions = Session::all()->reverse()->take(3);
        $activities = Activity::all()->reverse()->take(7);
        throw new \Exception("Tata");
        return view('pages.index', compact('campaigns', 'sessions', 'activities'));
    }
}
