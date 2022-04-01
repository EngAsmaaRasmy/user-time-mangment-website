<?php

namespace Database\Seeders;

use App\Models\RangeTime;
use Illuminate\Database\Seeder;

class TimeRangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = [
            [
                'id'         => 1,
                'user_id' => 2,
                'pharmacy_id'   => 1,
                'weekday'    => 1,
                'start_time' => '10:00',
                'end_time'   => '12:00',
            ],
            [
                'id'         => 2,
                'user_id' => 2,
                'pharmacy_id'   => 1,
                'weekday'    => 1,
                'start_time' => '12:00',
                'end_time'   => '14:00',
            ],
            [
                'id'         => 3,
                'user_id' => 2,
                'pharmacy_id'   => 1,
                'weekday'    => 1,
                'start_time' => '14:00',
                'end_time'   => '16:00',
            ],
            [
                'id'         => 4,
                'user_id' => 2,
                'pharmacy_id'   => 1,
                'weekday'    => 2,
                'start_time' => '16:00',
                'end_time'   => '18:00',
            ],
            [
                'id'         => 5,
                'user_id' => 2,
                'pharmacy_id'   => 1,
                'weekday'    => 3,
                'start_time' => '18:00',
                'end_time'   => '20:00',
            ],
            [
                'id'         => 6,
                'user_id' => 2,
                'pharmacy_id'   => 1,
                'weekday'    => 3,
                'start_time' => '20:00',
                'end_time'   => '22:00',
            ],
            [
                'id'         => 7,
                'user_id' => 2,
                'pharmacy_id'   => 1,
                'weekday'    => 3,
                'start_time' => '22:00',
                'end_time'   => '00:00',
            ],
        ];

        RangeTime::insert($times);
    }
}
