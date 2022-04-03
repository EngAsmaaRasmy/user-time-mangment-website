<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\RangeTime;
use App\Models\User;
use Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Services\CalendarService;
use Carbon\Carbon as CarbonCarbon;
use Symfony\Component\HttpFoundation\Response;

class TimesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dataRange_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $times = RangeTime::all();

        return view('admin.times.index', compact('times'));
    }

    public function create()
    {
        abort_if(Gate::denies('dataRange_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.times.create', compact('users'));
    }

    public function store(Request $request)
    {
        if ($request->input('start_date') > $request->input('end_date')) {
            toastr()->error('The start time is greater than the end time');
            return redirect()->back();
        } else {
            $weekDays = RangeTime::getDatesFromRange($request->input('start_date'), $request->input('end_date'));
            $time     = RangeTime::create($request->all());
            $tableId   = $time->id;
            toastr()->success('Time Table created Successfully');
            $calendarData = CalendarService::generateCalendarData($weekDays);
            return view('admin.calendar', compact('weekDays', 'calendarData', 'tableId'));
        }
    }

    public function edit(RangeTime $time)
    {
        abort_if(Gate::denies('dataRange_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacies = Pharmacy::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $time->load('pharmacy', 'user');

        return view('admin.times.edit', compact('pharmacies', 'users', 'time'));
    }

    public function update(Request $request, RangeTime $time)
    {
        $time->update($request->all());

        return redirect()->route('admin.times.index');
    }

    public function show(RangeTime $time)
    {
        abort_if(Gate::denies('dataRange_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $time->load('pharmacy', 'user');

        return view('admin.times.show', compact('time'));
    }

    public function destroy(RangeTime $time)
    {
        abort_if(Gate::denies('dataRange_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $time->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        RangeTime::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
