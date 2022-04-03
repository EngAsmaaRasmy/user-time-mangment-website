<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    public function pharmacyTimes()
    {
        return $this->hasMany(Event::class, 'pharmacy_id', 'id');
    }

    public function pharmacyUsers()
    {
        return $this->hasMany(User::class, 'pharmacy_id', 'id');
    }
}
