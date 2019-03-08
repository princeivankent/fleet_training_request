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
        $query = Schedule::all();

        foreach ($query as $key => $value) {
			$query[$key]['startDate'] = new Carbon($value->start_date);
			$query[$key]['endDate']   = new Carbon($value->end_date);

			$all_dates = [];
			while ($query[$key]['startDate']->lte($query[$key]['endDate'])){
				$all_dates[] = $query[$key]['startDate']->toDateString();
				$query[$key]['startDate']->addDay();
			}

			$query[$key]['date_range'] = $all_dates;
		}

		return response()->json($query);
    }

    public function show($schedule_id)
    {
        return Schedule::findOrFail($schedule_id);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'start_date'          => 'required|date',
            'end_date'            => 'required|date',
            'reason'              => 'string|nullable',
            'training_request_id' => 'nullable|exists:training_requests,training_request_id',
            'created_by'          => 'required|string'
        ]);

        $query                      = new Schedule;
        $query->start_date          = Carbon::parse($request->date)->format('Y-m-d');
        $query->end_date            = Carbon::parse($request->date)->format('Y-m-d');
        $query->reason              = $request->reason;
        $query->training_request_id = $request->training_request_id;
        $query->created_by          = $request->created_by;
        $query->save();
        
        return response()->json($query);
    }

    public function update(Request $request, $schedule_id)
    {
        $this->validate($request, [
            'start_date'          => 'required|date',
            'end_date'            => 'required|date',
            'reason'              => 'string|nullable'
        ]);

        $query = Schedule::findOrFail($schedule_id);
        $query->start_date          = Carbon::parse($request->date)->format('Y-m-d');
        $query->end_date            = Carbon::parse($request->date)->format('Y-m-d');
        $query->reason              = $request->reason;
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