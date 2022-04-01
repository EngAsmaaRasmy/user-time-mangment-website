<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::findOrFail(1)->rolesUsers()->sync(1);
        Role::findOrFail(2)->rolesUsers()->sync(2);
    }
}
