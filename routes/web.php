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
//     return redirect()->route('auth.login');
// });

// Route::get('/', function(){
//     return redirect()->route('home')->name('home');
// });

Auth::routes();

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
    
    Route::get('movie/now-playing', 'MovieController@showNowPlayingList')->name('movie.now-playing');
    Route::get('movie/comming-soon', 'MovieController@showComingSoonList')->name('movie.comming-soon');
    Route::post('movie/recommend', 'MovieController@recommend')->name('movie.recommend');
    Route::get('movie/search', 'MovieController@search')->name('movie.search');

    Route::get('theater', 'TheaterController@index')->name('theater.index');
    Route::get('theater/{movie_id}', 'TheaterController@indexForOnlyOneMovie')->name('theater.index.{movie_id}');
    Route::post('theater/detail', 'TheaterController@detail')->name('theater.detail');
    
    Route::post('schedule', 'ScheduleController@schedule')->name('schedule');
    Route::post('schedule/movie', 'ScheduleController@scheduleForOnlyOneMovie')->name('schedule.movie');
    Route::get('schedule/seatmap/{schedule_id}', 'ScheduleController@seatmap')->name('schedule.seatmap');
    Route::get('schedule/pair/{id}', 'ScheduleController@showPairList')->name('schedule.pair');
    Route::get('schedule/join-pair', 'ScheduleController@joinPair')->name('schedule.join-pair');
    Route::get('schedule/self-add', 'ScheduleController@selfAdd')->name('schedule.self-add');
    // Route::post('choose-seat', 'TheaterController@chooseSeat')->name('theater.choose-seet');

    Route::middleware('auth')->group(function(){
        Route::get('user/profile', 'UserController@profile')->name('user.profile');
        Route::post('user/update', 'UserController@update')->name('user.update');
        Route::post('user/like', 'UserController@like')->name('user.like');
        Route::post('user/unlike', 'UserController@unlike')->name('user.unlike');
        Route::post('user/bill', 'UserController@bill')->name('user.bill');

        Route::post('ticket/delete', 'TicketController@delete')->name('ticket.delete');
        Route::get('ticket/modify/{schedule_id}', 'TicketController@modify')->name('ticket.modify');
        Route::get('ticket/update', 'TicketController@update')->name('ticket.update');
    });
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function (){
    Route::namespace('Auth')->group(function() {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.post');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });

    Route::middleware(['auth','admin'])->group(function() {
        Route::get('/', 'IndexController@index')->name('home');
        Route::resource('/setting/user', 'UserController', ['as' => 'setting']);
        // Route::resource('/setting/product', 'ProductController', ['as' => 'setting']);
        // Route::resource('/setting/invoice', 'InvoiceController', ['as' => 'setting']);
        // Route::get('/setting/invoiceitem/multiple_update','InvoiceItemController@multiple_update')->name('invoices_item_multiple_update');
//        Route::resource('/setting/invoiceitem', 'InvoiceItemController', ['as' => 'setting'])->only([
//            'destroy','edit','update','show'
//        ]);
        // Route::get('/setting/invoiceitem/destroy/{id}','InvoiceItemController@destroy')->name('setting.invoiceitem_destroy');


    });
});


// Route::group(['middleware' => ['auth']], function() {
//     Route::post('movies/like', 'MoviesController@like');
//     Route::post('movies/unlike', 'MoviesController@unlike');
// });
// Route::get('movies/likeCount', 'MoviesController@likeCount');
// Route::get('movies/ticketCount', 'MoviesController@ticketCount');

// Route::get('tickets/totalAmount', 'TheaterController@updateTotalAmount');

// Route::get('testChart', 'TheaterController@testChart');

// Route::get('users/test', 'UsersController@userLike');
// Route::get('users/profile', 'UsersController@profile');
// Route::post('users/update', 'UsersController@update');
// Route::post('users/tickets/delete', 'UsersController@ticketDelete');
// Route::get('users/tickets/modify/{schedule_id}', 'UsersController@ticketModify');

// Route::group(['middleware' => ['auth', 'admin']], function() {
//     Route::get('/admin', 'HomeController@admin');
//     Route::get('/admin/movies/nowplay', 'MoviesController@adminNowPlay');
//     Route::get('/admin/movies/comesoon', 'MoviesController@adminComeSoon');
//     Route::get('/admin/movies/allmovies', 'MoviesController@adminAllMovies');
//     Route::post('/admin/movies/delete', 'MoviesController@adminDelete');
//     Route::get('/admin/movies/info/{id}', 'MoviesController@adminInfo');
//     Route::post('/admin/movies/update', 'MoviesController@adminUpdate');
//     Route::get('/admin/movies/movieDelete/{id}', 'MoviesController@adminDelete');
//     Route::post('/admin/movies/filterNowPlay', 'MoviesController@filterNowPlay');
//     Route::post('/admin/movies/filterComeSoon', 'MoviesController@filterComeSoon');
//     Route::get('/admin/movies/addMovie', 'MoviesController@addMovie');
//     Route::post('/admin/movies/add', 'MoviesController@add');

//     Route::get('/admin/users', 'UsersController@adminShow');
//     Route::get('/admin/users/info/{user_id}', 'UsersController@adminModify');
//     Route::get('/admin/users/update/{user_id}', 'UsersController@adminUpdate');
//     Route::post('/admin/users/deactivate', 'UsersController@adminDeactivate');
//     Route::post('/admin/users/activate', 'UsersController@adminActivate');
//     Route::post('/admin/users/delete', 'UsersController@adminDelete');
//     Route::get('/admin/users/form', 'UsersController@adminForm');
//     Route::post('/admin/users/insert', 'UsersController@adminInsert');

//     Route::get('/admin/all', 'TheaterController@adminAll');
//     Route::get('/admin/info/{id}', 'TheaterController@adminInfo');
//     Route::post('/admin/update', 'TheaterController@adminUpdate');
//     Route::get('/admin/delete/{id}', 'TheaterController@adminDelete');
//     Route::get('/admin/addTheater', 'TheaterController@adminAddTheater');
//     Route::post('/admin/add', 'TheaterController@adminAdd');
//     Route::get('/admin/theaterDetail', 'TheaterController@adminDetail');

//     Route::get('/admin/schedules/all', 'TheaterController@adminScheduleAll');
//     Route::get('/admin/schedules/addSchedule', 'TheaterController@adminAddSchedule');
//     Route::post('/admin/schedules/addSche', 'TheaterController@adminAddSche');
//     Route::get('/admin/schedules/delete/{id}', 'TheaterController@adminDeleteSchedule');
//     Route::get('/admin/schedules/info/{id}', 'TheaterController@adminScheduleInfo');
//     Route::post('/admin/schedules/update', 'TheaterController@adminUpdateSchedule');
//     Route::get('/admin/schedules/scheduleDetail', 'TheaterController@adminScheduleDetail');
//     Route::post('/admin/schedules/filter', 'TheaterController@adminFilter');
// });
