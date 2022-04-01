<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];

    public function permissionsRoles()
    {
        return $this->belongsToMany(Role::class);
    }
}
