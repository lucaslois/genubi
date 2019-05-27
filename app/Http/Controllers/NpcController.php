<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Campaign;
use App\Models\Npc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NpcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $campaign = Campaign::findOrFail($id);
        $selected_campaign = $campaign;
        $npcs = $campaign->npcs()->paginate(20);

        return view('pages.npcs.index', compact(
            'npcs',
            'campaign',
            'selected_campaign'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campaigns = Campaign::all();
        return view('pages.npcs.create', compact('campaigns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5'
        ]);
        $campaign = Campaign::findOrFail($request->campaign_id);
        $npc = new Npc;
        $npc->fill($request->all());
        $npc->enemy = $request->has('enemy');
        $npc->save();

        if($request->avatar) {
            $ext = $request->avatar->getClientOriginalExtension();
            $name = Str::slug($npc->name) . "_" . time() . "." . $ext;
            $request->avatar->storeAs('public/npcs', $name);

            $npc->avatar = Storage::url("public/npcs/$name");
            $npc->save();
        }

        Alert::send('El NPC se ha guardado correctamente');

        return redirect()->route('campaigns.npcs.index', $campaign->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $npc = Npc::findOrFail($id);

        return view('pages.npcs.edit', compact('npc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:5'
        ]);
        $npc = Npc::findOrFail($id);
        $npc->fill($request->all());
        $npc->enemy = $request->has('enemy');
        $npc->save();

        if($request->avatar) {
            $ext = $request->avatar->getClientOriginalExtension();
            $name = Str::slug($npc->name) . "_" . time() . "." . $ext;
            $request->avatar->storeAs('public/npcs', $name);

            $npc->avatar = Storage::url("public/npcs/$name");
            $npc->save();
        }

        $campaign = $npc->campaign;
        Alert::send('El NPC se ha guardado correctamente');

        return redirect()->route('campaigns.npcs.index', $campaign->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
