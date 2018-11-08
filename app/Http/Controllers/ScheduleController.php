<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Schedule;
use Carbon\Carbon;
use App\Http\Requests;

class ScheduleController extends Controller
{
    public function index()
    {
        return Schedule::all();
    }

    public function show($schedule_id)
    {
        return Schedule::findOrFail($schedule_id);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'created_by' => 'required|string'
        ]);

        $query = new Schedule;
        $query->date = Carbon::parse($request->date)->format('Y-m-d');
        $query->reason = $request->reason;
        $query->created_by = $request->created_by;
        $query->save();
        
        return response()->json($query);
    }

    public function update(Request $request, $schedule_id)
    {
        $query = Schedule::findOrFail($schedule_id);
        $query->date = $request->date;
        $query->reason = $request->reason;
        $query->save();
        
        return response()->json($query);
    }

    public function delete($schedule_id)
    {
        $query = Schedule::findOrFail($schedule_id);
        $query->delete();

        return response()->json($query);
    }
}