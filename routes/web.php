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
    function mainGlobalGroup(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/feedback', 'HomeController@feedback')->name('feedback');
    }


    Route::group(['domain' => '{locale}.bdsmzlu.club'], function (){mainGlobalGroup();});

    Route::group(['domain' => 'bdsmzlu.club'], function (){mainGlobalGroup();});


    Auth::routes();








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
