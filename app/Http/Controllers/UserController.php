<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store (Request $request) {

        $rules = $this->getRulesValidation("registration");
        $messages = $this->getMessagesValidation();

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $user = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->passwordUser)
        ]);

        session()->flash("success", "Регистрация пройдена");
        Auth::login($user);
        return redirect()->home();

    }

    function getRulesValidation ($typeRules): array
    {
        if ($typeRules == "login") {
            return  [
                "email"=>"required|email",
                "password"=>"required"
            ];
        } else {
            return [
                "name" => "required",
                "email" => "required|email|unique:users",
                "password" => "required|confirmed"
            ];
        }
    }

    function getMessagesValidation (): array
    {
        return [
            "name.required" => "Имя должно быть указано",
            "email.required" => "Email должен быть указан",
            "email.email" => "Указан некорректный формат email",
            "email.unique" => "Данный email уже используется",
            "password.required" => "Пароль должен быть указан",
            "password.confirmed" => "Пароль не совпадает"

        ];
    }

    public function login (Request $request) {
        $rules = $this->getRulesValidation("login");
        $messages = $this->getMessagesValidation();
        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        if (Auth::attempt([
            "email" => $request->email,
            "password"=> $request->passowrd
        ])) {
            return redirect()->home();
        }
        session()->flash("error", "Email или пароль введены не верно");
        return redirect()->home();
    }

    public function logout () {
        Auth::logout();
        return redirect()->home();
    }
}
