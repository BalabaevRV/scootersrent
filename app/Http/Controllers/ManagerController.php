<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Manager;
use App\Models\Point;
use App\Models\Scooter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    public function list () {
        $managers = Manager::with("user:id,name,email")->paginate(10);
        return view("admin.managersList", compact("managers"));
    }

    public function delete (Request $request)
    {
        $manager = Manager::find($request->id);
        if ($manager) {
            $manager->delete();
        }
        if (Route::currentRouteName() == "admin.managers.edit.delete") {
            return Redirect::route("admin.managers");
        } else {
            return Redirect::back();
        }
    }

    public function edit ($id) {
        $manager = Manager::find($id);
        $itIsEdit = true;
        if ($manager) {
            return view("admin.managerEdit", compact("manager", "itIsEdit"));
        }
        return Redirect::back();
    }


    public function new () {
        $manager = Manager::make();
        $users = User::has("manager", "=", 0)->OrderBy("id")->where("is_admin", 0)->get();
        $itIsEdit = false;
        return view("admin.managerEdit", compact("manager", "users", "itIsEdit"));
    }

    public function save (Request $request) {
        $rules = $this->getRulesValidation(!($request->id), ($request->infoChange));
        $messages = $this->getMessagesValidation();
        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        if (User::find($request->user_id)) {
            $arrayUser = $request->only("name", "email");
            DB::table("users")->where("id", $request->user_id)->update($arrayUser);
            session()->flash("success", "Информация о менеджере обновлена");
        }

        if (!($request->id)) {
            $arrayManager = $request->only("user_id");
            Manager::create($arrayManager);
            session()->flash("success", "Менеджер создан");
        }

        return Redirect::route("admin.managers");
    }

    function getRulesValidation ($itIsNew, $infoChange): array
    {

        $arrayValidation = [
            "name" => "required",
            "email" => "required|email",
        ];

        if ($infoChange) {
            $arrayValidation["email"] = $arrayValidation["email"]."|unique:users";
        }

        if ($itIsNew) {
            $arrayValidation["user_id"] = "required|unique:managers";
        }

        return $arrayValidation;
    }

    function getMessagesValidation (): array
    {
        return [
            "user_id.required" => "Нужно указать пользователя",
            "user_id.unique" => "Данный пользователь уже используется в качестве менеджера",
            "name.required" => "Нужно указать имя менеджера",
            "email.required" => "Нужно указать email пользователя",
            "email.email" => "Нужно указать email в корректном формате",
            "email.unique" => "Данный email уже используется"
        ];
    }

    public function manager() {
        return view("homepage");
    }

}
