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

        // Касса
        Route::group(['prefix' => 'kassa'], function (){
            Route::get("/", "KassaController@index")->name('kassa.index')->middleware('auth');
            Route::post("send", "KassaController@send")->name('kassa.send')->middleware('auth');
            Route::get('/test', "KassaController@test")->name('kassa.test');
        });

        // Админка
        Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function (){
            Route::get('/', "HomeController@index")->name('admin');
            Route::group(['namespace' => 'Connexion', 'prefix' => 'connexion'], function (){
                // подарки в знакоствах
                Route::resource('/gifts', 'GiftsController')->except('show')->names('admin.connexion.gifts');
            });

        });
        // знакомства
        Route::group(['namespace' => 'Connexion', 'prefix' => 'connexion'], function (){

            Route::group(['namespace' => 'Users'], function (){
                // мой профиль
                Route::group(['prefix' => 'my_profile', 'middleware' =>['auth']], function (){
                    Route::get('/', 'UserController@my_profile')->name('connexion.my_profile');
                    Route::post('/avatar', 'UserController@save_avatar')->name('connexion.my_profile.avatar');
                    Route::post('/avatar/remove', 'UserController@delete_avatar')->name('connexion.my_profile.avatar.remove');
                    Route::post('/greeting', 'UserController@change_greeting')->name('connexion.my_profile.greeting');
                    Route::post('/greeting/remove', 'UserController@delete_greeting')->name('connexion.my_profile.greeting.remove');
                    // настройки профиля
                    Route::group(['prefix' => 'settings'], function (){
                        Route::get('/', 'UserController@my_profile_edit')->name('connexion.my_profile.edit');
                        Route::patch('/update', "UserController@my_profile_update")->name('connexion.my_profile.update');
                        Route::get('/password', "UserController@my_profile_edit_password")->name('connexion.my_profile.edit.password');
                        Route::patch('/password/update', "UserController@my_profile_update_password")->name('connexion.my_profile.edit.password.update');
                        Route::get('/vip', "UserController@my_profile_edit_vip")->name('connexion.my_profile.edit.vip');
                        Route::patch('/vip/update', "UserController@my_profile_update_vip")->name('connexion.my_profile.update.vip');
                    });
                });
                // дарим подарки
                Route::group(['prefix' => 'profile/give', 'middleware' =>['auth']], function (){
                    Route::post("/gift", "GiftsForUserController@give_gifts")->name('connexion.profile.give.gift');
                });
                // профиль по id
                Route::get('/profile/{id}', 'UserController@profile')->name('connexion.profile');
                // по поиску
                Route::get('/profiles', 'UserController@profiles')->name('connexion.profiles');
            });
            // месседжер
            Route::group(['prefix' => 'messenger', 'middleware' =>['auth'], 'namespace' => 'Messenger'], function (){
                // показ контактов
                Route::get('/', 'ContactsController@all_lists')->name('connexion.messenger');
                Route::get('/main_list', 'ContactsController@main_list')->name('connexion.messenger.main_list');
                Route::get('/list_of_favorites', 'ContactsController@list_of_favorites')->name('connexion.messenger.list_of_favorites');
                Route::get('/black_list', 'ContactsController@black_list')->name('connexion.messenger.black_list');
                // cоздание нового контакта или редирект в существующий
                Route::post('/new_contact', 'ContactsController@new_contact')->name('connexion.messenger.new_contact')->middleware('messenger.new.contact');
                // изменение категории контакта или удаление
                Route::get('/update/{id}/main_list/contact', 'ContactsController@update_to_main_list')->name('connexion.messenger.update.contact.to_main_list');
                Route::get('/update/{id}/list_of_favorites/contact', 'ContactsController@update_to_list_of_favorites')->name('connexion.messenger.update.contact.to_list_of_favorites');
                Route::get('/update/{id}/black_list/contact', 'ContactsController@update_to_black_list')->name('connexion.messenger.update.contact.to_black_list');
                Route::get('/destroy/{id}/contact', 'ContactsController@destroy')->name('connexion.messenger.destroy.contact');
                Route::get('/notice/{code}', 'ContactsController@notice')->name('connexion.messenger.notice');
                // показ контакта с сообшениями
                Route::get('/contact/{id}', 'MessagesController@show_contact_with_massages')->name('connexion.messenger.show_contact');
                Route::post('/new_message/{id}', 'MessagesController@new_message')->name('connexion.messenger.new_message')->middleware('messenger.new.message');
                // фото для месседжера
                Route::group(['middleware' =>['messenger.attach.photo.vip']], function (){
                    Route::post('photos/attach/{id}', 'PhotosController@attach')->name('connexion.messenger.photos.attach');
                    Route::delete('/photos/destroy','PhotosController@destroy')->name('connexion.messenger.photos.destroy');
                    $method = ['show', 'store'];
                    Route::resource('/photos', 'PhotosController')->only($method)->names('connexion.messenger.photos');
                });
            });
            // фото пользователя
            Route::group(['namespace' => 'photos'], function (){
                Route::resource('/photos', 'PhotosController')->names('connexion.photos');
                Route::group(['prefix' => 'photos'], function (){
                    $method = ['store', 'destroy'];
                    Route::resource('/comment', 'PhotosCommentController')->only($method)->names('connexion.photos.comment');
                    Route::post('/like', 'PhotosLikesController@like')->name('connexion.photos.like');
                });
            });
        });
    };


    Route::group(['domain' => '{locale}.bdsmzlu.club', 'middleware' =>['user.alert'],], $mainGlobalGroup);

    Route::group(['domain' => 'bdsmzlu.club', 'middleware' =>['user.alert'],], $mainGlobalGroup);



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
