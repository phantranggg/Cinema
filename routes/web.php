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

        Route::get('/movie/nowplay', 'MovieController@nowPlay')->name('movie.nowPlay');
        Route::get('/movie/comesoon', 'MovieController@comeSoon')->name('movie.comeSoon');
        Route::post('/movie/filterNowPlay','MovieController@filterNowPlay');
        Route::get('/movie/index', 'MovieController@index')->name('movie.index');
        Route::get('/movie/show/{movie_id}', 'MovieController@show')->name('movie.show');
        Route::get('/movie/create', 'MovieController@create')->name('movie.create');
        Route::post('/movie/store', 'MovieController@store')->name('movie.store');
        Route::post('/movie/destroy/', 'MovieController@destroy')->name('movie.destroy');

        Route::post('/movie/update', 'MovieController@update')->name('movie.update');

        Route::get('/theater/index', 'TheaterController@index');
        Route::get('/theater/create', 'TheaterController@create') -> name('theater.create');
        Route::post('/theater/store', 'TheaterController@store')->name('theater.store');
        Route::get('/theater/destroy/{id}', 'TheaterController@destroy');
        Route::get('/theater/show/{theater_id}', 'TheaterController@show');
        Route::post('/theater/update', 'TheaterController@update');

        Route::get('/user/index', 'UserController@index')->name('user.index');
        Route::get('/user/show/{user_id}', 'UserController@show');
        Route::post('/user/update/', 'UserController@update')->name('user.update');
        Route::get('/user/create', 'UserController@create') -> name('user.create');
        Route::post('/user/store', 'UserController@store')->name('user.store');
        Route::get('/user/destroy/', 'UserController@destroy');

        Route::get('/schedule/index', 'ScheduleController@index')->name('schedule.index');
        Route::get('/schedule/show/{schedule_id}', 'ScheduleController@create')->name('schedule.create');
        Route::get('/schedule/create', 'ScheduleController@create')->name('schedule.create');
        Route::post('/schedule/store', 'ScheduleController@store')->name('schedule.store');
        Route::get('/schedule/destroy/{id}', 'ScheduleController@destroy')->name('schedule.destroy');
//        Route::get('/schedule/filter/','ScheduleController@filter')->name('schedule.filter');
        Route::get('/schedule/filter/','ScheduleController@filter')->name('schedule.filter');

    });
});
