<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Campaign;
use App\Models\Homebrew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomebrewController extends Controller
{
    public function index($id) {
        $selected_campaign = Campaign::findOrFail($id);
        $homebrews = $selected_campaign->homebrews()->paginate(20);

        return view('pages.homebrews.index',compact('selected_campaign', 'homebrews'));
    }

    public function create() {
        $user = Auth::user();
        $campaigns = $user->campaigns;

        return view('pages.homebrews.create', compact('campaigns'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        $user = Auth::user();
        $campaign = Campaign::findOrFail($request->campaign_id);
        $homebrew = new Homebrew;
        $homebrew->fill($request->all());
        $homebrew->user_id = $user->id;
        $homebrew->save();

        Alert::send('La regla de la casa se ha creado exitosamente');

        return redirect()->route('campaigns.homebrews.index', compact('campaign'));
    }

    public function show($id) {
        $homebrew = Homebrew::findOrFail($id);
        $selected_campaign = $homebrew->campaign;

        return view('pages.homebrews.show', compact('homebrew', 'selected_campaign'));
    }

    public function edit($id) {
        $homebrew = Homebrew::findOrFail($id);
        $selected_campaign = $homebrew->campaign;

        return view('pages.homebrews.edit', compact('homebrew', 'selected_campaign'));
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        $homebrew = Homebrew::findOrFail($id);
        $homebrew->fill($request->all());
        $homebrew->save();

        Alert::send('La regla de la casa se ha guardado exitosamente');

        return redirect()->route('homebrews.show', $homebrew->id);
    }

    public function remove($id) {
        $homebrew = Homebrew::findOrFail($id);
        $campaign = $homebrew->campaign;
        $homebrew->delete();

        return redirect()->route('campaigns.homebrews.index', $campaign->id);
    }
}
