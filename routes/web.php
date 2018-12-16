<?php


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




    Route::middleware('admin')->group(function() {
        Route::get('/', 'IndexController@index')->name('home');

        Route::get('/movies/nowplay', 'MovieController@nowPlay');
        Route::get('/movies/comesoon', 'MovieController@comeSoon');
        Route::get('/movies/allmovies', 'MovieController@allMovies');
        Route::get('/movies/addMovie', 'MovieController@addMovie');
        Route::post('/movies/delete/', 'MovieController@delete');
        Route::post('/movies/add', 'MovieController@add');
        Route::post('/movies/filterNowPlay','MovieController@filterNowPlay');
        Route::get('/movies/info/{id}', 'MovieController@info');
        Route::post('/movies/update', 'MovieController@update');

        Route::get('/theaters/all', 'TheaterController@all');
        Route::get('/theaters/addTheater', 'TheaterController@addTheater');
        Route::post('/theaters/add', 'TheaterController@add')->name('addTheater');
        Route::get('/theaters/delete/{id}', 'TheaterController@delete');

        Route::get('/users', 'UserController@show');
        Route::get('/users/info/{user_id}', 'UserController@modify');
        Route::post('/users/update/', 'UserController@update')->name('updateUser');

        Route::get('/schedules/all', 'ScheduleController@scheduleAll')->name('AllSchedule');
        Route::get('/schedules/addSchedule', 'ScheduleController@addSchedule');
        Route::post('/schedules/addSche', 'ScheduleController@addSche')->name('addSchedule');
        Route::get('/schedules/delete/{id}', 'ScheduleController@deleteSchedule');

    });
});


// Route::group(['middleware' => ['auth']], function() {
//     Route::post('movies/like', 'MovieController@like');
//     Route::post('movies/unlike', 'MovieController@unlike');
// });
// Route::get('movies/likeCount', 'MovieController@likeCount');
// Route::get('movies/ticketCount', 'MovieController@ticketCount');

// Route::get('tickets/totalAmount', 'TheaterController@updateTotalAmount');

// Route::get('testChart', 'TheaterController@testChart');

// Route::get('users/test', 'UserController@userLike');
// Route::get('users/profile', 'UserController@profile');
// Route::post('users/update', 'UserController@update');
// Route::post('users/tickets/delete', 'UserController@ticketDelete');
// Route::get('users/tickets/modify/{schedule_id}', 'UserController@ticketModify');

// Route::group(['middleware' => ['auth', 'admin']], function() {
//     Route::get('/admin', 'HomeController@admin');
//     Route::get('/admin/movies/nowplay', 'MovieController@adminNowPlay');
//     Route::get('/admin/movies/comesoon', 'MovieController@adminComeSoon');
//     Route::get('/admin/movies/allmovies', 'MovieController@adminAllMovies');
//     Route::post('/admin/movies/delete', 'MovieController@adminDelete');
//     Route::get('/admin/movies/info/{id}', 'MovieController@adminInfo');
//     Route::post('/admin/movies/update', 'MovieController@adminUpdate');
//     Route::get('/admin/movies/movieDelete/{id}', 'MovieController@adminDelete');
//     Route::post('/admin/movies/filterNowPlay', 'MovieController@filterNowPlay');
//     Route::post('/admin/movies/filterComeSoon', 'MovieController@filterComeSoon');
//     Route::get('/admin/movies/addMovie', 'MovieController@addMovie');
//     Route::post('/admin/movies/add', 'MovieController@add');

//     Route::get('/admin/users', 'UserController@adminShow');
//     Route::get('/admin/users/info/{user_id}', 'UserController@adminModify');
//     Route::get('/admin/users/update/{user_id}', 'UserController@adminUpdate');
//     Route::post('/admin/users/deactivate', 'UserController@adminDeactivate');
//     Route::post('/admin/users/activate', 'UserController@adminActivate');
//     Route::post('/admin/users/delete', 'UserController@adminDelete');
//     Route::get('/admin/users/form', 'UserController@adminForm');
//     Route::post('/admin/users/insert', 'UserController@adminInsert');

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
