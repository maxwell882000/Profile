<?php

use App\Http\Controllers\Api\Main\BrandController;
use App\Http\Controllers\Api\Main\MainController;
use App\Http\Controllers\Api\Main\ShopController;
use Illuminate\Support\Facades\Route;


Route::prefix("/home")
    ->group(function () {
        Route::get("/", [MainController::class, "main"]);
        Route::get("/category/", [MainController::class, "category"]);
        Route::get("/hitProduct/", [MainController::class, "hitProduct"]);
        Route::get("/products/", [MainController::class, "products"]);
        Route::get("/shop/", [ShopController::class, "shop"]);
        Route::get("/brand/", [BrandController::class, "brand"]);

// new added
        Route::get("/header/", [MainController::class, "header"]);
        Route::get("/lenta/", [MainController::class, 'lenta']);
        Route::get("/category-in-home/", [MainController::class, 'categoryInHome']);
    });
