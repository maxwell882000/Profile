<?php

use App\Http\Controllers\Api\Shop\ShopController;
use Illuminate\Support\Facades\Route;

Route::prefix("/shop")->group(function () {
    Route::get("/{shop}/", [ShopController::class, "getShop"]);
    Route::get("/", [ShopController::class, 'getAllShop']);
});
