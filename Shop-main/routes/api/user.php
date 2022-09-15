<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Authorization;
use App\Http\Controllers\Api\Verification\UserCreditDataController;
use  App\Http\Controllers\Api\Profile\UserController;

Route::middleware([
    "auth:sanctum",
])->group(function () {
    Route::middleware(["ability:server-full"])->group(function () {
        Route::post("/avatar/", [UserController::class, "avatar"]);
        Route::put("/userData/", [UserController::class, "userData"]);
        Route::post("/verification/userData/", [UserCreditDataController::class, "createUserData"]);
        Route::post("/verification/suretyData/{takenCredit}/", [UserCreditDataController::class, "createSurety"]);
        Route::get("/user/", [Authorization\AuthController::class, "getUser"])->middleware(
            "phone");
        Route::post("/changePassword/",
            [Authorization\PasswordController::class, "changePassword"])
            ->middleware("phone");
        Route::get("/logout/",
            [Authorization\AuthController::class, "logout"]);
        Route::post("/phoneCodeVerify/",
            [Authorization\VerifyCodeController::class, "phoneCodeVerify"]);
    });
    Route::middleware([
        "ability:server-password"
    ])->group(function () {
        Route::post("/forgetPassword/",
            [Authorization\PasswordController::class, "forgetPassword"]);
    });

    Route::middleware([
        "ability:server-password,server-full"
    ])->group(function () {
        Route::get("/sendCode/",
            [Authorization\VerifyCodeController::class, "sendCode"]);
        Route::post("/verifyCode/",
            [Authorization\VerifyCodeController::class, "verifyCode"]);
    });

});


Route::post("/issueTokenForPassword/",
    [Authorization\PasswordController::class, "issuePasswordToken"]);


// without middleware
Route::post("/login/",
    [Authorization\AuthController::class, "login"]);
Route::post("/register/",
    [Authorization\RegisterController::class, "register"]);

