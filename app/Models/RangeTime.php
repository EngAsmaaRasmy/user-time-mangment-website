<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangeTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'end_date',
        'user_id',
        'start_date',
        'created_at',
        'updated_at',
    ];

    public function getDatesFromRange($start_date, $end_date)
    {

        $start = Carbon::createFromFormat('Y-m-d', $start_date);
        $end = Carbon::createFromFormat('Y-m-d', $end_date);

        $dates = [];

        while ($start->lte($end)) {

            $dates[] = $start->copy()->format('Y-m-d');

            $start->addDay();
        }

        return $dates;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
