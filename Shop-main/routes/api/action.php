<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Action\BasketController;
use App\Http\Controllers\Api\Action\FavouriteController;

//added new
Route::middleware([
    "auth:sanctum",
    "ability:server-full"
])->prefix("action/")->group(function () {
    Route::prefix("basket/")->group(function () {
        Route::post("{product}/", [BasketController::class, "basket"]);
        Route::delete("remove/{product}/", [BasketController::class, 'removeBasket']);
        Route::put("{order}/updateOrderSelect", [BasketController::class, "updateOrderSelect"]);
        Route::put("{order}/", [BasketController::class, "updateOrder"]);
        Route::delete("{order}/", [BasketController::class, "destroyOrder"]);
        Route::post("destroy/orders/", [BasketController::class, "massDestroyOrder"]);
    });
    Route::get("favourite/{product}/", [FavouriteController::class, "favourite"]);
});
