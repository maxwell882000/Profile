<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommentAndMark\ProductCommentMarkController;

//added new
Route::middleware([
    "auth:sanctum",
    "ability:server-full"
])->prefix("comment/")->group(function () {
    Route::post("{product}/", [ProductCommentMarkController::class, "leftComment"]);
    Route::get("{product}/", [ProductCommentMarkController::class, "viewComment"]);
});
