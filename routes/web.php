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
        Route::get('/polygon', 'HomeController@polygon')->name('polygon');
        Route::get('/feedback', 'HomeController@feedback')->name('feedback');
        Route::post('/feedback', 'HomeController@feedbackSend')->name('feedback.post');

        Route::group(['namespace' => 'Connexion', 'prefix' => 'connexion'], function (){
            // мой профиль
            Route::group(['prefix' => 'my_profile', 'middleware' =>['auth']], function (){
                Route::get('/', 'UserController@my_profile')->name('connexion.my_profile');
                Route::post('/avatar', 'UserController@save_avatar')->name('connexion.my_profile.avatar');
                Route::post('/avatar/remove', 'UserController@delete_avatar')->name('connexion.my_profile.avatar.remove');
                Route::post('/greeting', 'UserController@change_greeting')->name('connexion.my_profile.greeting');
                Route::post('/greeting/remove', 'UserController@delete_greeting')->name('connexion.my_profile.greeting.remove');
            });
            // все профили
            Route::get('/profile/{id}', 'UserController@profile')->name('connexion.profile');
            // по поиску
            Route::get('/profiles', 'UserController@profiles')->name('connexion.profiles');



//            $method = ['edit', 'store', 'update', 'create', 'destroy'];
//            Route::resource('profiles', 'UserController')->only($method)->names('connexion.profiles');
        });
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
