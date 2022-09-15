<?php

use App\Http\Controllers\Api\QuestionAndAnswer\QuestionController;
use Illuminate\Support\Facades\Route;

Route::prefix("/question")->group(function () {
    Route::get("/", [QuestionController::class, "index"]);
});

