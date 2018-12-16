<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    const ACTIVE = 1;
    protected $table = 'movies';

    protected $fillable = ['title', 'release_date', 'genres', 'score', 'director', 'country', 'length', 'subtitle', 'rating', 'status','url'];


    public function likes() {
        return $this->hasMany('\App\Like');
    }

    public function schedules() {
        return $this->hasMany('App\Schedule');
    }
       
    public function checkLike($movieId) 
    {
        $logged = \Auth::user();
        if (is_null($logged)) {
            return FALSE;
        }
        $check = \DB::table('likes')->where('user_id', '=', $logged->id)
                ->where('movie_id', '=', $movieId)
                ->first();
        if (is_null($check)) {
            return FALSE;
        }
        return TRUE;
    }
    
    public function nowPlaying($limit) {
        $movies = DB::select("SELECT m.* FROM movies m
                        WHERE ?::date >= release_date::date 
                        AND 14 >= (select ?::date - release_date::date from movies where movies.id = m.id)
                        AND status = 1
                        ORDER BY ticket_num DESC, like_num DESC
                        LIMIT ?", [config('constant.today'), config('constant.today'), $limit]);
        return $movies;
    }
    
    public function commingSoon($limit) {
        $movies = DB::select("SELECT m.* FROM movies m
                        WHERE release_date::date > ?::date
                        AND 14 >= (select release_date::date - ?::date from movies where movies.id = m.id)
                        AND status = 1
                        ORDER BY ticket_num DESC, like_num DESC
                        LIMIT ?", [config('constant.today'), config('constant.today'), $limit]);
        return $movies;
    }
    
    public function nowPlayingFilter($theaterId) {
        $movies = DB::select('select m.*, count(tickets.id) as count_ticket
                                from movies m
                                left join schedules on m.id = schedules.movie_id
                                left join tickets on schedules.id = tickets.schedule_id
                                where theater_id = ?
                                and ?::date >= release_date::date 
                                and 14 >= (select ?::date - release_date::date from movies where movies.id = m.id)
                                and m.status = 1
                                group by m.id
                                order by count_ticket desc, like_num desc', [$theaterId, config('constant.today'), config('constant.today')]);
        return $movies;
    }
    
    public function commingSoonFilter($thearterId) {
        $movies = DB::select('select m.*, count(tickets.id) as count_ticket
                                from movies m
                                left join schedules on m.id = schedules.movie_id
                                left join tickets on schedules.id = tickets.schedule_id
                                where theater_id = ?
                                and release_date::date > ?::date
                                and 14 >= (select release_date::date - ?::date from movies where movies.id = m.id)
                                and m.status = 1
                                group by m.id
                                order by like_num desc, count_ticket desc', [$theaterId, config('constant.today'), config('constant.today')]);
        return $movies;
    }
}
