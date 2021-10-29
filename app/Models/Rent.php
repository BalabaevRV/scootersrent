<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id",
        "manager_id",
        "point_id",
        "scooter_id",
        "amount",
        "date_start",
        "date_end",
        "document",
        "status"
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
//       return $this->hasOneThrough(User::class, Customer::class);
//        return $this->hasManyThrough(Customer::class, Customer::class);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function point()
    {
        return $this->belongsTo(Point::class);
    }

    public function scooter()
    {
        return $this->belongsTo(Scooter::class);
    }
}
