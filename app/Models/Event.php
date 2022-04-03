<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'end_time',
        'table_id',
        'start_time',
        'weekday',
        'pharmacy_id',
        'created_at',
        'updated_at',
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

    public function table()
    {
        return $this->belongsTo(RangeTime::class, 'table_id');
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
