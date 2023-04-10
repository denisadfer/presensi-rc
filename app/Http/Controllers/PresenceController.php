<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePresenceRequest;
use App\Http\Requests\UpdatePresenceRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

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

        $position = User::where('id',$request->user_id)->get('position');
        $sp = Position::where('position', $position[0]['position'])->first();
        
        sscanf($work_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $time_seconds = $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
        $salary = (int)($time_seconds/28800)*$sp->salary;
        if ($time_seconds%28800 >= 3600) {
            $bonus = (int)($time_seconds%28800/3600)*10000;
        } else {
            $bonus = 0;
        }

        Presence::where(['user_id'=>$request->user_id, 'work_date'=>$request->work_date, 'time_in'=>$time_in[0]['time_in']])->update([
            'time_out' => $request->time_out,
            'work_time' => $work_time,
            'salary' => $salary,
            'bonus' => $bonus
        ]);

        return redirect('/home');
    }
    
    public function presence()
    {
        $user = Auth::user()->id;
        return view('user.presence', [
            "title" => "Presence",
            "presences" => Presence::all()->where('user_id', $user)->whereBetween('work_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ]);
    }
    
    public function list_user_presence($id)
    {
        return view('admin.presence', [
            "title" => "Presence",
            "presence" => Presence::all()->where('user_id', $id)
        ]);
    }
    
    public function presence_filter(Request $request)
    {
        $week = CarbonImmutable::parse($request->week);
        return view('admin.presence', [
            "title" => "Presence",
            "presence" => Presence::all()->where('user_id', $request->id)->whereBetween('work_date', [$week->startOfWeek(), $week->endOfWeek()])
        ]);
    }

}