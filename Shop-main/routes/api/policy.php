<?php

use App\Http\Controllers\Api\Policy\PolicyController;
use Illuminate\Support\Facades\Route;

Route::prefix("/policies")->group(function () {
    Route::get("/", [PolicyController::class, "index"]);
});
