<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Pharmacy;
use App\Models\RangeTime;
use App\Services\CalendarService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function userCalendar(CalendarService $calendarService)
    {
        $time  =  RangeTime::where('user_id', auth()->user()->id)->first();
        $weekDays = $time->getDatesFromRange($time->start_date, $time->end_date);
        $calendarData = $calendarService->generateCalendarData($weekDays);
        return view('admin.userCalendar', compact('weekDays', 'calendarData'));
    }
    public function index(Request $request, CalendarService $calendarService)
    {
        $weekDays = RangeTime::getDatesFromRange($request->input('start_date'), $request->input('end_date'));
        $tableId   = $request->input('table_id');
        $calendarData = $calendarService->generateCalendarData($weekDays);
        return view('admin.calendar', compact('weekDays', 'calendarData', 'tableId'));
    }
    public function search(Request $request, CalendarService $calendarService)
    {
        $weekDays = RangeTime::getDatesFromRange($request->input('start_date'), $request->input('end_date'));
        $calendarData = $calendarService->generateCalendarData($weekDays);
        return view('admin.userCalendar', compact('weekDays', 'calendarData'));
    }
    public function createEvent(Request $request)
    {
        $tableId = $request->input('table_id');
        $table   = RangeTime::where('id', $tableId)->first();
        $weekDays = RangeTime::getDatesFromRange($table->start_date, $table->end_date);
        $pharmacies = Pharmacy::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.events.create', compact('pharmacies', 'tableId', 'weekDays'));
    }
    public function store(Request $request)
    {
        $event = Event::create($request->all());
        $event->user_id = $event->table->id;
        $event->save();
        return redirect()->route("admin.events.index");
    }

}
