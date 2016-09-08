<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('results','ResultController@index');
Route::get('results/lottery/{idLottery}','ResultController@indexOfLottery');

Route::get('lotteries','LotteryController@index');
Route::get('lotteries/{id}','LotteryController@show');
Route::post('import_result','ResultController@import');