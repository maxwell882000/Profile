<?php

use App\Domain\Core\Front\Admin\Routes\Routing\ModeratorRoutesInterface;
use Illuminate\Support\Facades\Route;

Route::name("moderator.")->prefix("/moderator")->group(function () {
    Route::middleware('moderator')->group(function () {

    });
    Route::resources(
        [
            ModeratorRoutesInterface::PRODUCT => \App\Http\Controllers\Moderator\ModeratorProductController::class
        ]
    );
});



