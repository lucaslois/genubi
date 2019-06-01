<?php

namespace App\Http\Controllers;

use App\Models\Npc;
use App\Facades\Alert;
use App\Models\Campaign;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class NpcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $campaign = Campaign::findOrFail($id);
        $selected_campaign = $campaign;
        $query = $campaign->npcs();

        if($request->search)
            $query->where('name', 'LIKE', "%$request->search%");
        if($campaign->user->isNot(auth()->user()))
            $query->wherePublic(true);

        $npcs = $query->orderBy('name')->paginate(10);

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
        $user = Auth::user();
        abort_if(!$user, 401);
        $campaigns = $user->campaigns;
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
            'name' => 'required|min:1'
        ]);
        $user = Auth::user();
        abort_if(!$user, 401);

        $campaign = Campaign::findOrFail($request->campaign_id);
        $npc = new Npc;
        $npc->fill($request->all());
        $npc->enemy = $request->has('enemy');
        $npc->public = $request->has('public');
        $npc->save();

        if($request->avatar) {
            $ext = $request->avatar->getClientOriginalExtension();
            $name = Str::slug($npc->name) . "_" . time() . "." . $ext;
            $img = Image::make($request->avatar);
            $img->fit(300);
            $path = "public/npcs/$name";
            Storage::put($path, $img->stream());

            $npc->avatar = Storage::url($path);
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
        $user = Auth::user();
        $selected_campaign = $npc->campaign;
        abort_if($selected_campaign->user->isNot($user), 401);

        return view('pages.npcs.edit', compact('npc', 'selected_campaign'));
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
            'name' => 'required|min:1'
        ]);
        $npc = Npc::findOrFail($id);
        $user = Auth::user();
        abort_if($npc->campaign->user->isNot($user), 401);

        $npc->fill($request->all());
        $npc->enemy = $request->has('enemy');
        $npc->public = $request->has('public');
        $npc->save();

        if($request->avatar) {
            $ext = $request->avatar->getClientOriginalExtension();
            $name = Str::slug($npc->name) . "_" . time() . "." . $ext;
            $img = Image::make($request->avatar);
            $img->fit(300);
            $path = "public/npcs/$name";
            Storage::put($path, $img->stream());

            $npc->avatar = Storage::url($path);
            $npc->save();
        }

        $campaign = $npc->campaign;
        Alert::send('El NPC se ha guardado correctamente');

        return redirect()->route('campaigns.npcs.index', $campaign->id);
    }

    public function show($id) {
        $npc = Npc::findOrFail($id);
        $selected_campaign = $npc->campaign;

        return view('pages.npcs.show', compact('npc', 'selected_campaign'));
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
