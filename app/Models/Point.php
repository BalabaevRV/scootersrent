<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        "city",
        "address",
    ];

    public function scooters () {
        return $this->hasMany(Scooter::class);
    }
}
