<?php

namespace App\Services;

use App\Models\RangeTime;

class CalendarService
{
    public function generateCalendarData($weekDays)
    {
        $calendarData = [];
        $timeService  = new TimeService();
        $timeRange = $timeService->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        $times   = RangeTime::with('pharmacy', 'user')
            ->calendarByRoleOrClassId()
            ->get();
        foreach ($timeRange as $time) {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day) {
                $userTime = $times->where('weekday', $index)->where('start_time', $time['start'])->first();
                if ($userTime) {
                    array_push($calendarData[$timeText], [
                        'pharmacy_name'   => $userTime->pharmacy->name,
                        'user_name'       => $userTime->user->name,
                        'rowspan'      => $userTime->difference / 30 ?? ''
                    ]);
                } else if (
                     !$times->where('weekday', $index)
                    ->where('start_time', '<', $time['start'])
                    ->where('end_time', '>=', $time['end'])->count()
                ) {
                            array_push($calendarData[$timeText], 1);
                } else {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }

        return $calendarData;
    }
}
