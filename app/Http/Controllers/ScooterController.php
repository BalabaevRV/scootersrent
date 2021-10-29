<?php

namespace App\Http\Controllers;

use App\Jobs\removeBooking;
use App\Models\Point;
use App\Models\Scooter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ScooterController extends Controller
{
    public function list (Request $request) {
        $isAdmin = Auth::user()->is_admin;
        $scooters = Scooter::with("point:id,city,address")->OrderBy("id", "asc")
            ->when($request->point_id, function ($query, $point_id) {
                return $query->where("point_id", $point_id);
            })
            ->when(!$isAdmin, function ($query) {
                return $query->where("is_booking", 0)->where("rent_id", 0);
            })
            ->paginate(10);
        if ($isAdmin)
            return view("admin.scootersList", compact("scooters"));
        else {
            $points = Point::OrderBy("city")->get();
            return view("customer.scootersList", compact("scooters", "points"));
        }
    }

    public function delete (Request $request)
    {
        $scooter = Scooter::find($request->id);
        if ($scooter) {
            $scooter->delete();
        }
        if (Route::currentRouteName() == "admin.scooters.edit.delete") {
            return Redirect::route("admin.scooters");
        } else {
            return Redirect::back();
        }
    }

    public function edit ($id) {
        $scooter = Scooter::find($id);
        $itIsEdit = true;
        if ($scooter) {
            $points = Point::OrderBy("city")->OrderBy("address")->get();
            return view("admin.scooterEdit", compact("scooter", "points", "itIsEdit"));
        }
        return Redirect::back();
    }


    public function new () {
        $points = Point::OrderBy("city")->OrderBy("address")->get();
        $scooter = Scooter::make();
        $itIsEdit = false;
        return view("admin.scooterEdit", compact("scooter","points", "itIsEdit"));
    }

    public function save (Request $request) {
        $rules = $this->getRulesValidation();
        $messages = $this->getMessagesValidation();
        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $arrayValues = $request->only("name", "description", "price", "point_id", "img");

        if ($request->hasFile("img")) {
            $folder = date("Y-m-d");
            $img = $request->file("img")->store("images/{$folder}", "public");
            $arrayValues["img"] = $img;
        }
        if (Scooter::find($request->id)) {
            DB::table("scooters")->where("id", $request->id)->update($arrayValues);
            session()->flash("success", "Скутер обновлен");
        } else {
            Scooter::create($arrayValues);
            session()->flash("success", "Скутер создан");
        }
        return Redirect::route("admin.scooters");
    }

    function getRulesValidation (): array
    {
        return [
            "name" => "required",
            "description" => "required",
            "price" => "required|min:1",
            "point_id" => "required",
            "img" => "nullable|image"
        ];
    }

    function getMessagesValidation (): array
    {
        return [
            "name.required" => "Название должно быть указано",
            "description.required" => "Описание должно быть указан",
            "price.required" => "Цена должна быть указана",
            "price.min" => "Цена должна быть положительной",
            "point_id.required" => "Укажите точку выдачи",
            "img.image" => "Загрузите изображение в корректном формате (jpg, jpeg, png, bmp, gif, svg, or webp)",
        ];
    }

    public function toBook ($id) {
        $idUser =auth()->user()->id;
        $scooter = Scooter::where("customerBook", $idUser)->get();
        if ($scooter->count()) {
            session()->flash("error", "Вы уже забронировали скутер ".$scooter[0]->name);
        } else {
            $scooter = Scooter::find($id);
            $scooter->is_booking = 1;
            $scooter->customerBook = $idUser;
            $scooter->save();
            $job = (new removeBooking($id))->delay(Carbon::now()->addMinutes(15));
            dispatch($job);
            session()->flash("success", "Скутер ".$scooter->name." Забронирован на 15 минут");
        }
        return Redirect::back();
    }

    public function getBookingScooters () {
        $scooters = Scooter::OrderBy("id")->with("point")->with("user")->where("is_booking", 1)->get();
//        dd($scooters);
        return view ("manager.bookingList", compact("scooters"));
    }
}
