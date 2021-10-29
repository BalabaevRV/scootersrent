<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function list () {
        $customers = Customer::with("user:id,name,email")->paginate(10);
        return view("admin.customersList", compact("customers"));
    }

    public function delete (Request $request)
    {
        $customer = Customer::find($request->id);
        if ($customer) {
            $customer->delete();
        }
        if (Route::currentRouteName() == "admin.customer.edit.delete") {
            return Redirect::route("admin.customers");
        } else {
            return Redirect::back();
        }
    }

    public function edit ($id) {
        $customer = Customer::find($id);
        $itIsEdit = true;
        if ($customer) {
            return view("admin.customerEdit", compact("customer", "itIsEdit"));
        }
        return Redirect::back();
    }


    public function new () {
        $customer = Customer::make();
        $users = User::has("customer", "=", 0)->OrderBy("id")->where("is_admin", 0)->get();
        $itIsEdit = false;
        return view("admin.customerEdit", compact("customer", "users", "itIsEdit"));
    }

    public function save (Request $request) {
        $rules = $this->getRulesValidation(!($request->id), ($request->infoChange));
        $messages = $this->getMessagesValidation();
        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        if (User::find($request->user_id)) {
            $arrayUser = $request->only("name", "email");
            DB::table("users")->where("id", $request->user_id)->update($arrayUser);
            session()->flash("success", "Информация о продавце обновлена");
        }

        if (!($request->id)) {
            $arrayManager = $request->only("user_id");
            Customer::create($arrayManager);
            session()->flash("success", "Продавец создан");
        }

        return Redirect::route("admin.customers");
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
            $arrayValidation["user_id"] = "required|unique:customers";
        }

        return $arrayValidation;
    }

    function getMessagesValidation (): array
    {
        return [
            "user_id.required" => "Нужно указать пользователя",
            "user_id.unique" => "Данный пользователь уже используется в качестве клиента",
            "name.required" => "Нужно указать имя клиента",
            "email.required" => "Нужно указать email пользователя",
            "email.email" => "Нужно указать email в корректном формате",
            "email.unique" => "Данный email уже используется"
        ];
    }

    public function customersByManager () {
        $rents =
        $customers = Customer::with("user")->get();
        return view("manager.customerList", compact("customers"));
    }
}
