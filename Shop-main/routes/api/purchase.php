<?php

use  Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Purchase\PreparePurchaseController;
use App\Http\Controllers\Api\Purchase\DeliveryController;
use \App\Http\Controllers\Api\Purchase\WayOfPaymentController;
use App\Http\Controllers\Api\Purchase\PurchaseController;

Route::prefix("/purchase/")->group(function () {
    Route::prefix("search/")->group(function () {
        Route::get("city/", [DeliveryController::class, "searchCity"]);
        Route::get("shop/location/",
            [DeliveryController::class, 'searchShop']); // not used till the time when longitude and latitude  is required
        Route::get('shop/', [DeliveryController::class, 'getShops']);
    });
    Route::get("", [PurchaseController::class, "getPurchases"]);
    Route::post("/cancel/payment/{payment}/", [PurchaseController::class, "cancelPayment"]);
    Route::post("/cancel/installment/{credit}/", [PurchaseController::class, "cancelInstallment"]);
    Route::post("/pay/installment/{monthPaid}/", [PurchaseController::class, 'payForMonth']);
    Route::post("delivery/calculate/price/", [DeliveryController::class, "calculateDeliveryPrice"]);
    Route::get("wayOfPayment/", [WayOfPaymentController::class, "getPayments"]);
    Route::middleware([
        "auth:sanctum",
        "ability:server-full",
        "can:create,\App\Domain\User\Entities\User"
    ])->group(function () {
        Route::post("store/", [
            PreparePurchaseController::class,
            "store"
        ]);
    });
});
