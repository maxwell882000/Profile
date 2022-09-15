<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CommentAndMark\ProductCommentMarkController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Product\CommentController;

Route::get("/filter/product/", [ProductController::class, "productFilterFull"]);
Route::prefix("/product/{product}")->middleware([
])->group(function () {
    Route::get("/", [ProductController::class, "view"]);
    Route::get("/rate/", [ProductController::class, "rate"]);
    Route::get("/comment/", [CommentController::class, "comments"]);
    Route::middleware([
        "auth:sanctum",
        "ability:server-full"
    ])->group(function () {
        Route::post("/comment/", [ProductCommentMarkController::class, "leftComment"]);
        Route::post("/comment/like/", [CommentController::class, "like"]);
        Route::post("/comment/dislike/", [CommentController::class, "disLike"]);
    });
});
