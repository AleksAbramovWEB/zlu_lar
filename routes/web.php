<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    $mainGlobalGroup =  function (){
        Auth::routes();
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/feedback', 'HomeController@feedback')->name('feedback');
        Route::post('/feedback', 'HomeController@feedbackSend')->name('feedback.post');
    };


    Route::group(['domain' => '{locale}.bdsmzlu.club'], $mainGlobalGroup);

    Route::group(['domain' => 'bdsmzlu.club'], $mainGlobalGroup);


    Route::group(['prefix' => "geo" ], function (){
            Route::post('regions/{id}', 'GeoController@region')->name('geo.regions');
            Route::post('cities/{id}', 'GeoController@cities')->name('geo.cities');
    });









//Route::get('welcome/{locale}', function ($locale) {
//    App::setLocale($locale);
//
//    //
//});
//Route::domain('{account}.myapp.com')->group(function () {
//    Route::get('user/{id}', function ($account, $id) {
//        //
//    });
//});
