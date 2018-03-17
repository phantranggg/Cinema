<?php

namespace App\Repositories\Movie;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Auth;

class MovieEloquentRepository extends EloquentRepository implements MovieRepositoryInterface {
    
    public function getModel() {
        return \App\Movie::class;
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
    
    public function getNowPlaying($limit) {
        $nowPlayingMovies = \DB::select("SELECT m.* FROM movies m
                        WHERE ?::date >= release_date::date 
                        AND 14 >= (select ?::date - release_date::date from movies where movies.id = m.id)
                        AND status = 1
                        ORDER BY ticket_num DESC, like_num DESC
                        LIMIT ?", [config('constant.today'), config('constant.today'), $limit]);
        return $nowPlayingMovies;
    }
    
    public function getCommingSoon($limit) {
        $commingSoonMovies = \DB::select("SELECT m.* FROM movies m
                        WHERE release_date::date > ?::date
                        AND 14 >= (select release_date::date - ?::date from movies where movies.id = m.id)
                        AND status = 1
                        ORDER BY ticket_num DESC, like_num DESC
                        LIMIT ?", [config('constant.today'), config('constant.today'), $limit]);
        return $commingSoonMovies;
    }
    
    public function like($movieId) {
        \DB::table('likes')->insert(['movie_id' => $movieId, 'user_id' => Auth::id()]);
        //$movie = $this->find($movieId);
        //die(var_dump($movie));
        $movie = \App\Movie::find($movieId);
        $movie->like_num = $movie->like_num + 1;
        $movie->save();
    }
    
    public function unlike($movieId) {
        \DB::table('likes')->where('movie_id', '=', $movieId)
                ->where('user_id', '=', Auth::id())->delete();
        $movie = \App\Movie::find($movieId);
        $movie->like_num = $movie->like_num - 1;
        $movie->save();
    }
    
    public function getAllMoviesInOrder() {
        $allmovies = $this->model->where('status', '=', 1)->orderBy('ticket_num', 'desc')->orderBy('like_num', 'desc')->get();
        return $allmovies;
        //$allmovies = \App\Movie::where('status', '=', 1)->orderBy('ticket_num', 'desc')->orderBy('like_num', 'desc')->get();
    }
    
    public function getNowPlayingFilter($theaterId) {
        $movies = \DB::select('select m.*, count(tickets.id) as count_ticket
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
    
    public function getCommingSoonFilter($thearterId) {
        $movies = \DB::select('select m.*, count(tickets.id) as count_ticket
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

