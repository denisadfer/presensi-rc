<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use App\Http\Requests\StorePresenceRequest;
use App\Http\Requests\UpdatePresenceRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePresenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePresenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function show(Presence $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function edit(Presence $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePresenceRequest  $request
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresenceRequest $request, Presence $presence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presence $presence)
    {
        //
    }

    public function presence_in(Request $request)
    {
        Presence::create([
            'user_id' => $request->user_id,
            'work_date' => $request->work_date,
            'time_in' => $request->time_in,
        ]);

        return redirect('/home');
    }

    public function presence_out(Request $request)
    {
        $time_in = Presence::where(['user_id'=>$request->user_id, 'work_date'=>$request->work_date])->get('time_in');
        $ti = new DateTime($time_in[0]['time_in']);
        $to = new DateTime($request->time_out);
        $interval = $ti->diff($to);
        $work_time = $interval->format("%H:%i:%s");

        Presence::where(['user_id'=>$request->user_id, 'work_date'=>$request->work_date, 'time_in'=>$time_in[0]['time_in']])->update([
            'time_out' => $request->time_out,
            'work_time' => $work_time
        ]);

        return redirect('/home');
    }

    public function presence()
    {
        $user = Auth::user()->id;
        return view('user.presence', [
            "title" => "Presence",
            "presences" => Presence::all()->where('user_id', $user)
        ]);
    }

    public function list_user_presence(Request $request)
    {
        $user = $request->user_id;
        return view('admin.presence', [
            "title" => "Presence",
            "presence" => Presence::all()->where('user_id', $user)
        ]);
    }
}