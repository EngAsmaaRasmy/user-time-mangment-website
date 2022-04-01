<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RangeTime;
use App\Services\CalendarService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(CalendarService $calendarService)
    {
        $weekDays     = RangeTime::WEEK_DAYS;
        $calendarData = $calendarService->generateCalendarData($weekDays);

        return view('admin.calendar', compact('weekDays', 'calendarData'));
    }
    public function search(Request $request)
    {
        $input = $request->all();
        // dd($input);
        // return view('admin.calendar', compact('weekDays', 'calendarData'));
    }
}
