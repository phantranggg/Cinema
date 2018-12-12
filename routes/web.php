<?php

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
// Route::get('/', function(){
//     return redirect()->route('customer.auth.login');
// });

// Route::get('/', function(){
//     return redirect()->route('customer.home')->name('customer.home');
// });

Auth::routes();
Route::get('/', 'Customer\HomeController@index');
Route::get('/home', 'Customer\HomeController@index');

Route::group(['prefix' => 'customer'], function(){
    Route::group(['prefix' => 'user'], function(){
        Route::get('profile', 'Customer\UserController@profile')->name('customer.user.profile');
        Route::post('like', 'Customer\UserController@like')->name('customer.user.like');
        Route::post('unlike', 'Customer\UserController@unlike')->name('customer.user.unlike');
        Route::post('bill', 'Customer\UserController@bill')->name('customer.user.bill');
        Route::post('ticket/delete', 'UsersController@ticketDelete');
        Route::get('ticket/modify/{schedule_id}', 'UsersController@ticketModify');
        // Route::post('ticket-delete', 'Customer\TheaterController@ticketDelete');
    });
    Route::group(['prefix' => 'movie'], function(){
        Route::get('now-playing', 'Customer\MovieController@showNowPlayingList')->name('customer.movie.now-playing');
        Route::get('comming-soon', 'Customer\MovieController@showComingSoonList')->name('customer.movie.comming-soon');
    });
    Route::group(['prefix' => 'theater'], function(){
        Route::get('index', 'Customer\TheaterController@index')->name('customer.theater.index');
        Route::get('index/{movie_id}', 'Customer\TheaterController@indexForOnlyOneMovie')->name('customer.theater.index.{movie_id}');
        Route::post('detail', 'Customer\TheaterController@detail')->name('customer.theater.detail');
        Route::post('schedule', 'Customer\TheaterController@schedule')->name('customer.theater.schedule');
        Route::post('schedule-movie', 'Customer\TheaterController@scheduleForOnlyOneMovie')->name('customer.theater.schedule-movie');
        Route::get('seatmap/{id}', 'Customer\TheaterController@seatmap')->name('customer.theater.seatmap');
        // Route::post('choose-seat', 'Customer\TheaterController@chooseSeat')->name('customer.theater.choose-seet');
        
    });
});




Route::group(['middleware' => ['auth']], function() {
    Route::post('movies/like', 'MoviesController@like');
    Route::post('movies/unlike', 'MoviesController@unlike');
});
Route::get('movies/likeCount', 'MoviesController@likeCount');
Route::get('movies/ticketCount', 'MoviesController@ticketCount');
Route::post('movies/recommend', 'MoviesController@recommendMovies');

Route::get('tickets/totalAmount', 'Customer\TheaterController@updateTotalAmount');

Route::get('testChart', 'Customer\TheaterController@testChart');

Route::get('users/test', 'UsersController@userLike');
Route::get('users/profile', 'UsersController@profile');
Route::post('users/update', 'UsersController@update');
Route::post('users/tickets/delete', 'UsersController@ticketDelete');
Route::get('users/tickets/modify/{schedule_id}', 'UsersController@ticketModify');

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/admin', 'HomeController@admin');
    Route::get('/admin/movies/nowplay', 'MoviesController@adminNowPlay');
    Route::get('/admin/movies/comesoon', 'MoviesController@adminComeSoon');
    Route::get('/admin/movies/allmovies', 'MoviesController@adminAllMovies');
    Route::post('/admin/movies/delete', 'MoviesController@adminDelete');
    Route::get('/admin/movies/info/{id}', 'MoviesController@adminInfo');
    Route::post('/admin/movies/update', 'MoviesController@adminUpdate');
    Route::get('/admin/movies/movieDelete/{id}', 'MoviesController@adminDelete');
    Route::post('/admin/movies/filterNowPlay', 'MoviesController@filterNowPlay');
    Route::post('/admin/movies/filterComeSoon', 'MoviesController@filterComeSoon');
    Route::get('/admin/movies/addMovie', 'MoviesController@addMovie');
    Route::post('/admin/movies/add', 'MoviesController@add');

    Route::get('/admin/users', 'UsersController@adminShow');
    Route::get('/admin/users/info/{user_id}', 'UsersController@adminModify');
    Route::get('/admin/users/update/{user_id}', 'UsersController@adminUpdate');
    Route::post('/admin/users/deactivate', 'UsersController@adminDeactivate');
    Route::post('/admin/users/activate', 'UsersController@adminActivate');
    Route::post('/admin/users/delete', 'UsersController@adminDelete');
    Route::get('/admin/users/form', 'UsersController@adminForm');
    Route::post('/admin/users/insert', 'UsersController@adminInsert');

    Route::get('/admin/all', 'Customer\TheaterController@adminAll');
    Route::get('/admin/info/{id}', 'Customer\TheaterController@adminInfo');
    Route::post('/admin/update', 'Customer\TheaterController@adminUpdate');
    Route::get('/admin/delete/{id}', 'Customer\TheaterController@adminDelete');
    Route::get('/admin/addTheater', 'Customer\TheaterController@adminAddTheater');
    Route::post('/admin/add', 'Customer\TheaterController@adminAdd');
    Route::get('/admin/theaterDetail', 'Customer\TheaterController@adminDetail');

    Route::get('/admin/schedules/all', 'Customer\TheaterController@adminScheduleAll');
    Route::get('/admin/schedules/addSchedule', 'Customer\TheaterController@adminAddSchedule');
    Route::post('/admin/schedules/addSche', 'Customer\TheaterController@adminAddSche');
    Route::get('/admin/schedules/delete/{id}', 'Customer\TheaterController@adminDeleteSchedule');
    Route::get('/admin/schedules/info/{id}', 'Customer\TheaterController@adminScheduleInfo');
    Route::post('/admin/schedules/update', 'Customer\TheaterController@adminUpdateSchedule');
    Route::get('/admin/schedules/scheduleDetail', 'Customer\TheaterController@adminScheduleDetail');
    Route::post('/admin/schedules/filter', 'Customer\TheaterController@adminFilter');
});
