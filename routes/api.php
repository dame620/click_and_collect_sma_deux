<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:api')->group(function() {

    Route::get('/user', function(Request $request) {
        return $request->user();
    });

    Route::namespace('Api')->group(function() {
        //this methode is for getting wrappers of connected user
        Route::get('/user-wrappers', 'WrappersController@index');
        //this methode is for getting the invoice of one package
        Route::get('/wrappers/{id}', 'WrappersController@show');
        //the methode is for register the package in the database
        Route::post('/package', 'PackageController@store')->name('package.store');
        //this methode is for wrappers with default statue
        Route::get('/default-wrappers', 'WrappersController@showdefault');
        //this methode is for gettiing all wrapper this is not used
        Route::get('/all-wrappers', 'WrappersController@showall');
        //this is for getting all shipments
        Route::get('/all-shipments', 'ShipmentController@showall');
        //this is for getting one shipment
        Route::get('/shipment/{id}', 'ShipmentController@show');
        //this is for getting shipment of connected user
        Route::get('/user-shipment', 'ShipmentController@showshipuser');
        //get the list of users
        Route::get('/list-user', 'UserController@showall');
    });



});
/*
Route::namespace('Api')->group(function() {
    Route::get('/invoiceproformafterfilldata', 'ShipmentController@index');
});
*/
