<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Movie;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pageTitle = "Trang Chủ";
        $movieObj = new Movie();

        $nowplay = $movieObj->nowPlaying(6);
        $comesoon = $movieObj->commingSoon(6);
        // echo 'ahahah';
        return view('home')->with([
                    'pageTitle' => $pageTitle,
                    'nowplay' => $nowplay,
                    'comesoon' => $comesoon,
                    'movieObj' => $movieObj
        ]);
    }

    protected function displayLiked() {
        $likes = [];
        if (Auth::check()) {
            $likes = DB::select('SELECT movie_id FROM likes WHERE user_id = ?', [Auth::id()]);
        }
        return $likes;
    }


    protected function admin() {
        $ticketNum = DB::select('SELECT count(*) FROM tickets');
        $movieNum = DB::select('SELECT count(*) FROM movies WHERE movies.status = 1');
        $theaterNum = DB::select('SELECT count(*) FROM theaters WHERE theaters.status = 1');
        $userNum = DB::select('SELECT count(*) FROM users WHERE users.status = 1');
        $theaters = DB::select('SELECT name,count(*)
        FROM theaters LEFT JOIN schedules ON (theaters.id = schedules.theater_id) 
                      JOIN tickets ON (schedules.id = tickets.schedule_id)
        GROUP BY theaters.id');
        $schedules = DB::select("SELECT count(schedule_id),  
                case	when date_part('hour', show_time) = 8 then 1
                    when date_part('hour', show_time) = 9 then 1
                    when date_part('hour', show_time) = 10 then 1
                    when date_part('hour', show_time) = 11 then 1
                    when date_part('hour', show_time) = 12 then 2
                    when date_part('hour', show_time) = 13 then 2
                    when date_part('hour', show_time) = 14 then 2
                    when date_part('hour', show_time) = 15 then 2
                    when date_part('hour', show_time) = 16 then 3
                    when date_part('hour', show_time) = 17 then 3
                    when date_part('hour', show_time) = 18 then 3
                    when date_part('hour', show_time) = 19 then 3
                    when date_part('hour', show_time) = 20 then 4
                    when date_part('hour', show_time) = 21 then 4
                    when date_part('hour', show_time) = 22 then 4
                    when date_part('hour', show_time) = 23 then 4
                end
            from tickets, schedules
            where schedule_id = schedules.id
            group by case 	when date_part('hour', show_time) = 8 then 1
                    when date_part('hour', show_time) = 9 then 1
                    when date_part('hour', show_time) = 10 then 1
                    when date_part('hour', show_time) = 11 then 1
                    when date_part('hour', show_time) = 12 then 2
                    when date_part('hour', show_time) = 13 then 2
                    when date_part('hour', show_time) = 14 then 2
                    when date_part('hour', show_time) = 15 then 2
                    when date_part('hour', show_time) = 16 then 3
                    when date_part('hour', show_time) = 17 then 3
                    when date_part('hour', show_time) = 18 then 3
                    when date_part('hour', show_time) = 19 then 3
                    when date_part('hour', show_time) = 20 then 4
                    when date_part('hour', show_time) = 21 then 4
                    when date_part('hour', show_time) = 22 then 4
                    when date_part('hour', show_time) = 23 then 4
                end

            order by (count(schedule_id)) DESC");
        $users = DB::select("SELECT count(id),  
                case    when (2017 - date_part('year', date_of_birth)) < 13 then 1	
                    when (2017 - date_part('year', date_of_birth)) between 13 and 18 then 2
                    when (2017 - date_part('year', date_of_birth)) between 19 and 30 then 3
                    when (2017 - date_part('year', date_of_birth)) between 31 and 50 then 4
                    when (2017 - date_part('year', date_of_birth)) > 50 then 5
                end
            from users
            group by case    when (2017 - date_part('year', date_of_birth)) < 13 then 1	
                when (2017 - date_part('year', date_of_birth)) between 13 and 18 then 2
                when (2017 - date_part('year', date_of_birth)) between 19 and 30 then 3
                when (2017 - date_part('year', date_of_birth)) between 31 and 50 then 4
                when (2017 - date_part('year', date_of_birth)) > 50 then 5
            end

            order by (count(id)) DESC");

        $ticketCountByDay = DB::select('select show_date, count(tickets.id) as count
                                from tickets right join schedules on tickets.schedule_id = schedules.id 
                                group by show_date
                                order by show_date;');

        return view('admin', [
            'theaters' => $theaters,
            'schedules' => $schedules,
            'users' => $users,
            'ticketNum' => $ticketNum[0]->count,
            'movieNum' => $movieNum[0]->count,
            'theaterNum' => $theaterNum[0]->count,
            'userNum' => $userNum[0]->count,
            'ticketCountByDay' => $ticketCountByDay,
        ]);
    }

}
