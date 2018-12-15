<?php

Route::get('/admin', 'Admin\IndexController@index')->name('home');
Route::get('/admin/movies/nowplay', 'Admin\MoviesController@adminNowPlay');
Route::get('/admin/movies/comesoon', 'Admin\MoviesController@adminComeSoon');
Auth::routes();


//Route::resource('/setting/user', 'UserController', ['as' => 'setting']);

Route::namespace('Customer')->group(function(){
    Route::namespace('Auth')->group(function(){
        // Authentication Routes
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.post');
        Route::post('logout', 'LoginController@logout')->name('logout');

        // Registration Routes
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register')->name('register.post');

        // Password Reset Routes
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset.post');

    });
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('movies/now-playing', 'MovieController@showNowPlayingList')->name('movies.now-playing');
    Route::get('movies/comming-soon', 'MovieController@showComingSoonList')->name('movies.comming-soon');
    Route::post('movies/recommend', 'MovieController@recommend')->name('movies.recommend');

    Route::get('theater', 'TheaterController@index')->name('theater.index');
    Route::get('theater/{movie_id}', 'TheaterController@indexForOnlyOneMovie')->name('theater.index.{movie_id}');
    Route::post('theater/detail', 'TheaterController@detail')->name('theater.detail');
    Route::post('theater/schedule', 'TheaterController@schedule')->name('theater.schedule');
    Route::post('theater/schedule-movies', 'TheaterController@scheduleForOnlyOneMovie')->name('theater.schedule-movies');
    Route::get('theater/seatmap/{id}', 'TheaterController@seatmap')->name('theater.seatmap');
    // Route::post('choose-seat', 'TheaterController@chooseSeat')->name('theater.choose-seet');

    Route::middleware('auth')->group(function(){
        Route::get('user/profile', 'UserController@profile')->name('user.profile');
        Route::post('user/like', 'UserController@like')->name('user.like');
        Route::post('user/unlike', 'UserController@unlike')->name('user.unlike');
        Route::post('user/bill', 'UserController@bill')->name('user.bill');
        Route::post('user/ticket/delete', 'UserController@ticketDelete')->name('user.ticket-delete');
        Route::get('user/ticket/modify/{schedule_id}', 'UserController@ticketModify')->name('user.ticket-modify');
    });
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function (){
    Route::namespace('Auth')->group(function() {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.post');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });



    Route::middleware('admin')->group(function() {




    });
});


Route::group(['middleware' => ['auth']], function() {
    Route::post('movies/like', 'MoviesController@like');
    Route::post('movies/unlike', 'MoviesController@unlike');
});
Route::get('movies/likeCount', 'MoviesController@likeCount');
Route::get('movies/ticketCount', 'MoviesController@ticketCount');

Route::get('tickets/totalAmount', 'TheaterController@updateTotalAmount');

Route::get('testChart', 'TheaterController@testChart');

Route::get('users/test', 'UsersController@userLike');
Route::get('users/profile', 'UsersController@profile');
Route::post('users/update', 'UsersController@update');
Route::post('users/tickets/delete', 'UsersController@ticketDelete');
Route::get('users/tickets/modify/{schedule_id}', 'UsersController@ticketModify');

//Route::group(['middleware' => ['auth', 'admin']], function() {
//    Route::get('/admin', 'HomeController@admin');
//    Route::get('/admin/movies/nowplay', 'MoviesController@adminNowPlay');
//    Route::get('/admin/movies/comesoon', 'MoviesController@adminComeSoon');
//    Route::get('/admin/movies/allmovies', 'MoviesController@adminAllMovies');
//    Route::post('/admin/movies/delete', 'MoviesController@adminDelete');
//    Route::get('/admin/movies/info/{id}', 'MoviesController@adminInfo');
//    Route::post('/admin/movies/update', 'MoviesController@adminUpdate');
//    Route::get('/admin/movies/movieDelete/{id}', 'MoviesController@adminDelete');
//    Route::post('/admin/movies/filterNowPlay', 'MoviesController@filterNowPlay');
//    Route::post('/admin/movies/filterComeSoon', 'MoviesController@filterComeSoon');
//    Route::get('/admin/movies/addMovie', 'MoviesController@addMovie');
//    Route::post('/admin/movies/add', 'MoviesController@add');
//
//    Route::get('/admin/users', 'UsersController@adminShow');
//    Route::get('/admin/users/info/{user_id}', 'UsersController@adminModify');
//    Route::get('/admin/users/update/{user_id}', 'UsersController@adminUpdate');
//    Route::post('/admin/users/deactivate', 'UsersController@adminDeactivate');
//    Route::post('/admin/users/activate', 'UsersController@adminActivate');
//    Route::post('/admin/users/delete', 'UsersController@adminDelete');
//    Route::get('/admin/users/form', 'UsersController@adminForm');
//    Route::post('/admin/users/insert', 'UsersController@adminInsert');
//
//    Route::get('/admin/all', 'TheaterController@adminAll');
//    Route::get('/admin/info/{id}', 'TheaterController@adminInfo');
//    Route::post('/admin/update', 'TheaterController@adminUpdate');
//    Route::get('/admin/delete/{id}', 'TheaterController@adminDelete');
//    Route::get('/admin/addTheater', 'TheaterController@adminAddTheater');
//    Route::post('/admin/add', 'TheaterController@adminAdd');
//    Route::get('/admin/theaterDetail', 'TheaterController@adminDetail');
//
//    Route::get('/admin/schedules/all', 'TheaterController@adminScheduleAll');
//    Route::get('/admin/schedules/addSchedule', 'TheaterController@adminAddSchedule');
//    Route::post('/admin/schedules/addSche', 'TheaterController@adminAddSche');
//    Route::get('/admin/schedules/delete/{id}', 'TheaterController@adminDeleteSchedule');
//    Route::get('/admin/schedules/info/{id}', 'TheaterController@adminScheduleInfo');
//    Route::post('/admin/schedules/update', 'TheaterController@adminUpdateSchedule');
//    Route::get('/admin/schedules/scheduleDetail', 'TheaterController@adminScheduleDetail');
//    Route::post('/admin/schedules/filter', 'TheaterController@adminFilter');
//});
