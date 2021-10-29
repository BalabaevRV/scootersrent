<?php

namespace App\Http\Controllers;

use App\Models\Scooter;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin () {
        return view("admin.adminPage");
    }

    public function pointsList () {
        return view("admin.pointsList");
    }

    public function managersList () {
        return view("admin.managersList");
    }

    public function clientsList () {
        return view("admin.clientsList");
    }
}
