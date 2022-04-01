<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use Illuminate\Database\Seeder;

class PharmaciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pharmacies = [
            [
                'id' => 1,
                'name' => 'First pharmacy'
            ],
            [
                'id' => 2,
                'name' => 'Second pharmacy'
            ]
        ];

        Pharmacy::insert($pharmacies);
    }
}
