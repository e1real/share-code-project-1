<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('campaigns')->group(function () {
    Route::get('delivery-status', 'App\Http\Controllers\Api\V1\CampaignsController@delivery_statuses')
        ->name('campaigns.delivery-status');
});
Route::resource('campaigns', 'App\Http\Controllers\Api\V1\CampaignsController');


Route::resource('screens', 'App\Http\Controllers\Api\V1\ScreensController');
Route::prefix('screens')->group(function () {
    Route::post('find-screen', 'App\Http\Controllers\Api\V1\ScreensController@find_screen')
        ->name('screens.find-screen');
});

Route::resource('screen-groups', 'App\Http\Controllers\Api\V1\ScreenGroupsController');

Route::resource('places', 'App\Http\Controllers\Api\V1\PlacesController');

Route::resource('place-photos', 'App\Http\Controllers\Api\V1\PlacePhotosController');

Route::resource('media', 'App\Http\Controllers\Api\V1\MediaController');
