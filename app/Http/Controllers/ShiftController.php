<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use App\Http\Requests\StoreShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use Error;
use Mockery\Undefined;
use PhpParser\Node\Expr\Throw_;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class ShiftController extends Controller
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
    public function add_shift(Request $request)
    {
        Shift::where('work_date', $request->work_date)->update([
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
        ]);
        return redirect('/admin/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShiftRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShiftRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShiftRequest  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShiftRequest $request, Shift $shift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        //
    }
}