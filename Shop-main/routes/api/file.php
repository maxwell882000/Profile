<?php

use Illuminate\Support\Facades\Route;

Route::post("/file/", [\App\Http\Controllers\Api\File\TempFileController::class, "uploadFile"]);
Route::post("/file/many/", [\App\Http\Controllers\Api\File\TempFileController::class, "uploadManyFile"]);
