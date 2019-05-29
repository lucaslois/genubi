<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Session;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $campaigns = Campaign::all()->take(3);
        $sessions = Session::all()->take(3);
        return view('pages.index', compact('campaigns', 'sessions'));
    }
}
