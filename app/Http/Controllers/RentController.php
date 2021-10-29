<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Point;
use App\Models\Rent;
use App\Models\Scooter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class RentController extends Controller
{
    public function getRentForm($id = null, $user = null) {
        $itIsEdit = (bool)$id;
        if ($id && $user) {
            $scooter = Scooter::find($id);
            $customer = User::find($user);
            $points = Point::all();
            return view("manager.rentForm", compact("scooter","customer", "points"));
        } elseif ($id) {
            $rent = Rent::with("scooter")->with("point")->with("customer.user")->find($id);
            return view("manager.rentForm", compact("rent","itIsEdit"));
        }  else {
            $scooters = Scooter::OrderBy("id")->where("rent_id", 0)->where("is_booking", 0)->get();
            $points = Point::all();
            $customers = Customer::with("user")->get();
             return view("manager.rentForm", compact( "points", "scooters", "customers"));
        }
    }

    public function saveRent (Request $request, $id = null)  {
        $rules = $this->getRulesValidation();
        $messages = $this->getMessagesValidation();
        $validator = Validator::make($request->all(), $rules, $messages)->validate();
        $scooter = Scooter::find($request->scooter_id);
        if ($id) {
            $rent = Rent::find($id);
            $rent->status = $request->status;
            if ($request->status == 1) {
                $scooter->rent_id = 0;
                $scooter->save();
            }
            $rent->save();
            session()->flash("success", "У Выдачи №" . $rent->id . " изменен статус");
        } else {
            $arrayData = $request->only("manager_id", "scooter_id", "point_id", "customer_id", "document", "amount", "date_end");
            $arrayData["status"] = 0;
            $rent = Rent::create($arrayData);
            $scooter->rent_id = $rent->id;
            $scooter->save();
            session()->flash("success", "Выдача №" . $rent->id . " создана");
        }
        return view("homepage");
    }

    function getRulesValidation() {
        return [
            "scooter_id" => "required",
            "point_id" => "required",
            "customer_id" => "required",
            "document" => "required",
            "amount" => "required",
            "date_end" => "required"
         ];
    }

    function getMessagesValidation() {
        return [
            "scooter_id.required" => "Укажите скутер",
            "point_id.required" => "Укажите точку выдачи",
            "customer_id.required" => "Укажите покупателя",
            "document.required" => "Укажите залоговую информацию",
            "amount.required" => "Укажите стоимость аренды",
            "date_end.required" => "Укажите дату возврата"
        ];
    }

    public function rentsByManager (Request $request) {
        $itIsEdit = Route::is("manager.openRents");
        $customers = [];
        $rents = Rent::orderBy("date_start")
            ->with("customer.user")
            ->with("scooter")
            ->with("point")
            ->where("manager_id", Auth::user()->manager->id)
            ->when($itIsEdit, function ($query) {
                return $query->where("status", "<", 2);
            })
            ->when($request->customer_id, function ($query, $customer_id) {
                return $query->where("customer_id", $customer_id);
            })
            ->paginate(10);
        if (!$itIsEdit) {
            $customers = Rent::orderBy("customer_id")
                ->with("customer.user")
                ->where("manager_id", Auth::user()->manager->id)
                ->select("customer_id")
                ->distinct()
                ->get();
        }

        return view("manager.rentsList", compact("rents", "itIsEdit", "customers"));
    }
}
