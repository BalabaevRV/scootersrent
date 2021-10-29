<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Manager;
use App\Models\Point;
use App\Models\Rent;
use App\Models\Scooter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sale () {
        $managers = Manager::with("user")->get();
        $customers = Customer::with("user")->get();;
        $scooters = Scooter::get();
        $points = Point::get();
        return view("reports.sale" , compact("managers", "customers", "scooters", "points"));
    }

    public function saleToForm (Request $request) {

        $rents = Rent::orderBy("id")->with("manager.user")->with("customer.user")->with("scooter")->with("point")
            ->when($request->manager, function ($query, $manager) {
                return $query->where("manager_id", $manager);
            })
            ->when($request->customer, function ($query, $customer) {
                return $query->where("customer_id", $customer);
            })
            ->when($request->scooter, function ($query, $scooter) {
                return $query->where("scooter_id", $scooter);
            })
            ->when($request->point, function ($query, $point) {
                return $query->where("point_id", $point);
            })
            ->get();

        $managers = Manager::with("user")->get();
        $customers = Customer::with("user")->get();;
        $scooters = Scooter::get();
        $points = Point::get();

        $params = $request->only("manager", "customer", "scooter", "point");

        return view("reports.sale", compact("rents","managers", "customers", "scooters", "points", "params"));
    }
}
