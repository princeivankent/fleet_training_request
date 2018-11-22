<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use MaddHatter\LaravelFullcalendar\Calendar;
use Illuminate\Http\Request;

use App\Http\Requests;

class CalendarController extends Controller
{
    public function events()
    {
        return view('admin.calendar');
    }

    public function get_events()
	{
		$data = $this->getModuleSchedules($this->getDealerId());
		$events = [];
		foreach ($data as $key => $value) {
			$end = Carbon::parse($value['end_date'])->addDays(1);
			$now = Carbon::now();

			$events[] = \Calendar::event(
				'PDF: ' . $value['module_schedule']['module']['module'], //event title
				true, //full day event?
				Carbon::parse($value['start_date'])->format('y-m-d'), //start time (you can also use Carbon instead of DateTime)
				Carbon::parse($value['end_date'])->addDays(1)->format('y-m-d'), //end time (you can also use Carbon instead of DateTime)
				$key, //optionally, you can specify an event ID
				[
					'color' => $end > $now ? '#7CB342' : '#E53935'
				]
			);
		}

		$exam_schedules = $this->getExamSchedules($this->getDealerId());
		foreach ($exam_schedules as $key => $value) {
			$end = Carbon::parse($value['end_date'])->addDays(1);
			$now = Carbon::now();

			$events[] = \Calendar::event(
				'EXAM: ' . $value['exam_schedule']['module']['module'], //event title
				true, //full day event?
				Carbon::parse($value['start_date'])->format('y-m-d'), //start time (you can also use Carbon instead of DateTime)
				Carbon::parse($value['end_date'])->addDays(1)->format('y-m-d'), //end time (you can also use Carbon instead of DateTime)
				$key, //optionally, you can specify an event ID
				[
					'color' => $end > $now ? '#29B6F6' : '#E53935'
				]
			);
		}

		$calendar = \Calendar::addEvents($events)
			->setOptions([
				'navLinks' => true,
				// 'editable' => true,
			]);

		return view('trainor.calendar', compact('calendar'));
	}
}
