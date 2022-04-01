<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Pharmacy;
use App\Models\RangeTime;
use App\Models\Role;
use App\Models\User;

class HomeController
{
    public function index()
    {
        $times = RangeTime::count();
        $pharmacies = Pharmacy::count();
        $users = User::count();
        $permissions = Permission::count();
        $roles = Role::count();
        return view('home', compact('times', 'pharmacies', 'users', 'permissions', 'roles'));
    }
}
