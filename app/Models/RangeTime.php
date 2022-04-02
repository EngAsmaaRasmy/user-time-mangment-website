<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangeTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekday',
        'pharmacy_id',
        'end_time',
        'user_id',
        'start_time',
        'created_at',
        'updated_at',
    ];

    const WEEK_DAYS = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday',
    ];

    public function getDifferenceAttribute()
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.rangeTime_time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.rangeTime_time_format'), $value)->format('H:i:s') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.rangeTime_time_format')) : null;
    }
    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(config('panel.rangeTime_time_format'), $value)->format('H:i:s') : null;
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class, 'pharmacy_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public static function isTimeAvailable($weekday, $startTime, $endTime, $pharmacy, $user, $time)
    {
        $times = self::where('weekday', $weekday)
            ->when($time, function ($query) use ($time) {
                $query->where('id', '!=', $time);
            })
            ->where(function ($query) use ($pharmacy, $user) {
                $query->where('pharmacy_id', $pharmacy)
                    ->orWhere('user_id', $user);
            })
            ->where([
                ['start_time', '<', $endTime],
                ['end_time', '>', $startTime],
            ])
            ->count();

        return !$times;
    }
    public function scopeCalendarByRoleOrClassId($query)
    {
        return $query->when(!request()->input('pharmacy_id'), function ($query) {
            $query->when(auth()->user()->is_user, function ($query) {
                $query->where('user_id', auth()->user()->id);
            });      
        })
            ->when(request()->input('pharmacy_id'), function ($query) {
                $query->where('pharmacy_id', request()->input('pharmacy_id'));
            });
    }
}
