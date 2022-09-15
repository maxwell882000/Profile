<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
include "api/policy.php";
include "api/user.php";
include "api/home.php";
include "api/category.php";
include "api/action.php";
include "api/product.php";
include "api/comment.php";
include "api/favourite.php";
include "api/search.php";
include "api/shop.php";
include "api/order.php";
include "api/purchase.php";
include "api/file.php";
include "api/plastic_card.php";
include "api/question.php";

Route::post('/sms/send_code', [UserController::class, 'send_code']);

Route::get("/banner", [\App\Http\Controllers\Api\Main\BrandController::class, "index"]);
