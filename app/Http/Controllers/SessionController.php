<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Models\Campaign;
use App\Models\Milestone;
use App\Models\Notification;
use App\Models\Session;
use App\Models\SessionPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SessionController extends Controller
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
        $query = $campaign->sessions();

        if($request->search)
            $query->where("name", "LIKE", "%$request->search%");

        $sessions = $query->paginate(9);

        return view('pages.sessions.index', compact(
            'sessions',
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
        return view('pages.sessions.create', compact('campaigns'));
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
            'name' => 'required|min:3|string',
            'date' => 'required|date'
        ]);
        $user = Auth::user();
        $session = new Session;
        $session->fill($request->all());
        $session->user_id = 1;

        $session->save();

        if($request->background_image) {
            $ext = $request->background_image->getClientOriginalExtension();
            $name = Str::slug($session->name) . "_" . time() . "." . $ext;
            $request->background_image->storeAs('public/sessions', $name);

            $session->background_image = Storage::url("public/sessions/$name");
            $session->save();
        }

        foreach($session->campaign->usersPlaying() as $participant)
            Notification::create([
                'user_id' => $participant->id,
                'text' => "{$user->name} ha creado la sesión {$session->name} en {$session->campaign->name}",
                'image' => $user->getImage(),
                'link' => route('sessions.show', $session->id)
            ]);

        Alert::send('La sesión se ha creado correctamente');

        return redirect()->route('sessions.show', $session->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::findOrFail($id);
        $selected_campaign = $session->campaign;

        return view('pages.sessions.show', compact('session', 'selected_campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::findOrFail($id);
        $selected_campaign = $session->campaign;

        return view('pages.sessions.edit', compact('session', 'selected_campaign'));
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
            'name' => 'required|min:3|string',
            'date' => 'required|date'
        ]);
        $session = Session::findOrFail($id);
        $session->fill($request->all());
        $session->save();

        if($request->background_image) {
            $ext = $request->background_image->getClientOriginalExtension();
            $name = Str::slug($session->name) . "_" . time() . "." . $ext;
            $request->background_image->storeAs('public/sessions', $name);

            $session->background_image = Storage::url("public/sessions/$name");
            $session->save();
        }

        Alert::send('La sesión se ha actualizado correctamente');

        return redirect()->route('sessions.show', $session->id);
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

    public function showAssignments($id) {
        $session = Session::findOrFail($id);
        $selected_campaign = $session->campaign;
        $npcs = $selected_campaign->npcs;

        return view('pages.sessions.assignments', compact('session', 'selected_campaign', 'npcs'));
    }

    public function storeAssignments($id, Request $request) {
        $session = Session::findOrFail($id);
        if($request->has('enemy'))
            $session->enemies()->attach($request->npc_id);
        else
            $session->npcs()->attach($request->npc_id);

        return redirect()->route('sessions.assignments.index', $session->id);
    }

    public function deleteAssignments($id, $npc_id, Request $request) {
        $session = Session::findOrFail($id);
        if($request->has('enemy'))
            $session->enemies()->detach($request->npc_id);
        else
            $session->npcs()->detach($request->npc_id);

        return redirect()->route('sessions.assignments.index', $session->id);
    }

    public function indexMilestones($id) {
        $session = Session::findOrFail($id);
        $selected_campaign = $session->campaign;
        $milestones = $session->milestones;

        return view('pages.sessions.milestones', compact('session', 'selected_campaign', 'milestones'));
    }

    public function storeMilestones($id, Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $session = Session::findOrFail($id);

        $milestone = new Milestone;
        $milestone->fill($request->all());
        $milestone->session_id = $session->id;
        if($request->avatar) {
            $ext = $request->avatar->getClientOriginalExtension();
            $name = Str::slug($milestone->name) . "_" . time() . "." . $ext;
            $request->avatar->storeAs('public/milestones', $name);

            $milestone->avatar = Storage::url("public/milestones/$name");
        }
        $milestone->save();

        return redirect()->route('sessions.milestones.index', $session->id);
    }

    public function deleteMilestones($id, $milestone_id, Request $request) {
        $session = Session::findOrFail($id);
        $milestone = Milestone::findOrFail($milestone_id);
        $milestone->delete();

        return redirect()->route('sessions.milestones.index', $session->id);
    }


}
