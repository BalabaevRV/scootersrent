<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ScooterController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {return view("homepage");})->name("home");


Route::post("/registration", [UserController::class, "store"])->name("registration.store");
Route::post("/login", [UserController::class, "login"])->name("login.login");
Route::get("/logout", [UserController::class, "logout"])->name("login.logout");


Route::group(["middleware"=>"admin", "prefix" => "admin"], function () {
    Route::get("/", [AdminController::class, "admin"])->name("admin");

    Route::get("/scooters", [ScooterController::class, "list"])->name("admin.scooters");
    Route::get("/scooter", [ScooterController::class, "new"])->name("admin.scooters.new");
    Route::delete("/scooters", [ScooterController::class, "delete"])->name("admin.scooters.delete");
    Route::get("/scooter/{id}", [ScooterController::class, "edit"])->name("admin.scooters.edit");
    Route::delete("/scooter", [ScooterController::class, "delete"])->name("admin.scooters.edit.delete");
    Route::post("/scooters", [ScooterController::class, "save"])->name("admin.scooters.save");

    Route::get("/points", [PointController::class, "list"])->name("admin.points");
    Route::get("/point", [PointController::class, "new"])->name("admin.point.new");
    Route::delete("/points", [PointController::class, "delete"])->name("admin.points.delete");
    Route::get("/point/{id}", [PointController::class, "edit"])->name("admin.point.edit");
    Route::delete("/point", [PointController::class, "delete"])->name("admin.point.edit.delete");
    Route::post("/points", [PointController::class, "save"])->name("admin.point.save");

    Route::get("/managers", [ManagerController::class, "list"])->name("admin.managers");
    Route::get("/manager", [ManagerController::class, "new"])->name("admin.managers.new");
    Route::delete("/managers", [ManagerController::class, "delete"])->name("admin.managers.delete");
    Route::get("/manager/{id}", [ManagerController::class, "edit"])->name("admin.managers.edit");
    Route::delete("/manager", [ManagerController::class, "delete"])->name("admin.managers.edit.delete");
    Route::post("/managers", [ManagerController::class, "save"])->name("admin.manager.save");

    Route::get("/customers", [CustomerController::class, "list"])->name("admin.customers");
    Route::get("/customer", [CustomerController::class, "new"])->name("admin.customers.new");
    Route::delete("/customers", [CustomerController::class, "delete"])->name("admin.customers.delete");
    Route::get("/customer/{id}", [CustomerController::class, "edit"])->name("admin.customers.edit");
    Route::delete("/customer", [CustomerController::class, "delete"])->name("admin.customers.edit.delete");
    Route::post("/customers", [CustomerController::class, "save"])->name("admin.customer.save");

    Route::get("/report/sale", [ReportController::class, "sale"])->name("admin.report.sale");
    Route::post("/report/sale", [ReportController::class, "saleToForm"])->name("admin.report.saleToForm");

});

Route::group(["middleware"=>"manager", "prefix" => "manager"], function () {
    Route::get("/", [ManagerController::class, "manager"])->name("manager");
    Route::get("/createRent", [RentController::class, "getRentForm"])->name("manager.createRent");
    Route::get("/createRent/{id}&{user}", [RentController::class, "getRentForm"])->name("manager.createRentByBooking");
    Route::post("/saveRent/{id?}", [RentController::class, "saveRent"])->name("manager.SaveRent");
    Route::get("/rents", [RentController::class, "rentsByManager"])->name("manager.openRents");
    Route::get("/rents/all", [RentController::class, "rentsByManager"])->name("manager.openAllRents");
    Route::POST("/rents/customer", [RentController::class, "rentsByManager"])->name("manager.rentByClient&Manager");
    Route::get("/rents/{id}", [RentController::class, "getRentForm"])->name("manager.editRent");
    Route::get("/booking", [ScooterController::class, "getBookingScooters"])->name("manager.bookingScooters");
});

Route::group(["middleware"=>"customer"], function () {
    Route::get("/scooters", [ScooterController::class, "list"])->name("scooterList");
    Route::get("/scooters/{id}", [ScooterController::class, "toBook"])->name("scooterToBook");
    Route::post("/scooters", [ScooterController::class, "list"])->name("scootersByPoint");
});

//Route::group(["middleware"=>"customer"], function () {
//    Route::get("/", [CustomerController::class, "customer"])->name("customer");
//});

