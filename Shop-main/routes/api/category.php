<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Category\CategoryViewController;

Route::get("/category/{parent}/{category}/", [CategoryViewController::class, "view"]);
Route::get("/category/{category}/", [CategoryViewController::class, "view"]); // will be used only this for now
Route::get("/category/{parent}/{sub_parent}/{category}/", [CategoryViewController::class, "view"]);
Route::get("/category/{parent}/{category}/brand/", [CategoryViewController::class, "brand"]);


//add new
Route::get("/product/category/{category}/getProduct/", [CategoryViewController::class, "productInCategory"]);
