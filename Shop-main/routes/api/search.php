<?php

use App\Http\Controllers\Api\Search\SearchController;
use  Illuminate\Support\Facades\Route;

Route::prefix("/search")->group(function () {
    Route::get("/", [SearchController::class, "searchHelpers"]);
    Route::get("/products/", [SearchController::class, 'searchProducts']);
});
