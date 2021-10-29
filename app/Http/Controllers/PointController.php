<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class PointController extends Controller
{
    public function list () {
        $points = Point::withCount("scooters")->OrderBy("city", "asc")->OrderBy("address", "asc")->paginate(10);

        return view("admin.pointsList", compact("points"));
    }

    public function delete (Request $request)
    {
        $point = Point::find($request->id);
        if ($point) {
            $point->delete();
        }
        if (Route::currentRouteName() == "admin.point.edit.delete") {
            return Redirect::route("admin.points");
        } else {
            return Redirect::back();
        }
    }

    public function edit ($id) {
        $point = Point::withCount("scooters")->find($id);
        $scooters = Point::find($id)->scooters;
        $itIsEdit = true;

        if ($point) {
            return view("admin.pointEdit", compact("point", "scooters", "itIsEdit"));
        }

        return Redirect::back();
    }


    public function new () {
        $point = Point::make();
        $itIsEdit = false;
        return view("admin.pointEdit", compact("point", "itIsEdit"));
    }

    public function save (Request $request) {
        $rules = $this->getRulesValidation();
        $messages = $this->getMessagesValidation();
        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $arrayValues = $request->only("city", "address");

        if (Point::find($request->id)) {
            DB::table("points")->where("id", $request->id)->update($arrayValues);
            session()->flash("success", "Точка выдачи обновлена");
        } else {
            Point::create($arrayValues);
            session()->flash("success", "Точка выдачи создана");
        }
        return Redirect::route("admin.points");
    }

    function getRulesValidation (): array
    {
        return [
            "city" => "required",
            "address" => "required"
        ];
    }

    function getMessagesValidation (): array
    {
        return [
            "city.required" => "Город должен быть указано",
            "address.required" => "Улица должна быть указана"
        ];
    }
}
