<?php

use  Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlasticCard\PlasticCardController;

Route::middleware([
    "auth:sanctum",
    "ability:server-full"
])->prefix("/plastic-card")->group(function () {
    Route::get("/", [PlasticCardController::class, "getCards"]);
    Route::post("/getTransactionForPlastic/", [PlasticCardController::class, "getTransactionForPlastic"]);
    Route::post("/dialCode/", [PlasticCardController::class, "dialCode"]);
    Route::post("/insertCard/", [PlasticCardController::class, "insertCard"]);
    Route::delete("/{card}/", [PlasticCardController::class, "revokeCard"]);
});
