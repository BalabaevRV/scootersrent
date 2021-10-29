<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scooter extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "img",
        "point_id",
        "price",
        "customerBook"
    ];

    public function Point () {
        return $this->belongsTo(Point::class);
    }

    public function User () {
        return $this->hasOne(User::class, "id", "customerBook");
    }
}
