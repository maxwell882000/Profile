<?php

use App\Http\Controllers\Api\Favourite\FavouriteController;
use  Illuminate\Support\Facades\Route;

Route::middleware([
    "auth:sanctum",
    "ability:server-full"
])->prefix("/favourite")->group(function () {
    Route::get("/", [FavouriteController::class, "getFavourite"]);
});
