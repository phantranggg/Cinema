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
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('movies/nowplay', 'MoviesController@nowplay');
Route::get('movies/comesoon', 'MoviesController@comesoon');

Route::group(['middleware' => ['auth']], function() {
    Route::post('movies/like', 'MoviesController@like');
    Route::post('movies/unlike', 'MoviesController@unlike');
});
Route::get('movies/likeCount', 'MoviesController@likeCount');
Route::get('movies/ticketCount', 'MoviesController@ticketCount');
Route::post('movies/recommend', 'MoviesController@recommendMovies');

Route::get('tickets/totalAmount', 'TheatersController@updateTotalAmount');

Route::get('theaters/testChart', 'TheatersController@testChart');

Route::get('theaters', 'TheatersController@index');
Route::get('theaters/{movie_id}', 'TheatersController@indexMovie');
Route::post('theaters/detail', 'TheatersController@detail');
Route::post('theaters/schedule', 'TheatersController@schedule');
Route::post('theaters/scheduleMovie', 'TheatersController@scheduleMovie');
Route::get('theaters/seatmap/{id}', 'TheatersController@seatmap');
Route::post('theaters/chooseSeat', 'TheatersController@chooseSeat');
Route::post('theaters/bill', 'TheatersController@bill');
Route::post('theaters/ticketDelete', 'TheatersController@ticketDelete');

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

    Route::get('/admin/theaters/all', 'TheatersController@adminAll');
    Route::get('/admin/theaters/info/{id}', 'TheatersController@adminInfo');
    Route::post('/admin/theaters/update', 'TheatersController@adminUpdate');
    Route::get('/admin/theaters/delete/{id}', 'TheatersController@adminDelete');
    Route::get('/admin/theaters/addTheater', 'TheatersController@adminAddTheater');
    Route::post('/admin/theaters/add', 'TheatersController@adminAdd');
    Route::get('/admin/theaters/theaterDetail', 'TheatersController@adminDetail');

    Route::get('/admin/schedules/all', 'TheatersController@adminScheduleAll');
    Route::get('/admin/schedules/addSchedule', 'TheatersController@adminAddSchedule');
    Route::post('/admin/schedules/addSche', 'TheatersController@adminAddSche');
    Route::get('/admin/schedules/delete/{id}', 'TheatersController@adminDeleteSchedule');
    Route::get('/admin/schedules/info/{id}', 'TheatersController@adminScheduleInfo');
    Route::post('/admin/schedules/update', 'TheatersController@adminUpdateSchedule');
    Route::get('/admin/schedules/scheduleDetail', 'TheatersController@adminScheduleDetail');
    Route::post('/admin/schedules/filter', 'TheatersController@adminFilter');
});
