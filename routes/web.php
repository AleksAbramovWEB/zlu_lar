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

        // знакомства
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
            // месседжер
            Route::group(['prefix' => 'messenger', 'middleware' =>['auth'], 'namespace' => 'Messenger'], function (){
                // показ контактов
                Route::get('/', 'ContactsController@all_lists')->name('connexion.messenger');
                Route::get('/main_list', 'ContactsController@main_list')->name('connexion.messenger.main_list');
                Route::get('/list_of_favorites', 'ContactsController@list_of_favorites')->name('connexion.messenger.list_of_favorites');
                Route::get('/black_list', 'ContactsController@black_list')->name('connexion.messenger.black_list');
                // cоздание нового контакта или редирект в существующий
                Route::post('/new_contact', 'ContactsController@new_contact')->name('connexion.messenger.new_contact')->middleware('new.contact');
                // изменение категории контакта или удаление
                Route::get('/update/{id}/main_list/contact', 'ContactsController@update_to_main_list')->name('connexion.messenger.update.contact.to_main_list');
                Route::get('/update/{id}/list_of_favorites/contact', 'ContactsController@update_to_list_of_favorites')->name('connexion.messenger.update.contact.to_list_of_favorites');
                Route::get('/update/{id}/black_list/contact', 'ContactsController@update_to_black_list')->name('connexion.messenger.update.contact.to_black_list');
                Route::get('/destroy/{id}/contact', 'ContactsController@destroy')->name('connexion.messenger.destroy.contact');
                // показ контакта с сообшениями
                Route::get('/contact/{id}', 'MessagesController@show_contact_with_massages')->name('connexion.messenger.show_contact');
                Route::post('/new_message/{id}', 'MessagesController@new_message')->name('connexion.messenger.new_message')->middleware('new.message');
            });

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

    // отправка тайм зоны блаузера
    Route::post('/timezone', 'HomeController@timezone')->name('timezone');









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
