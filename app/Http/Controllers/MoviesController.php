<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Movie\MovieEloquentRepository;

class MoviesController extends Controller {

    protected $movieRepository;

    public function __construct(MovieEloquentRepository $movieRepository) {
        $this->movieRepository = $movieRepository;
        
    }

    protected function likeCount() {
        $count = \DB::select('select movies.id, count(likes.id) as count '
                        . 'from likes right join movies '
                        . 'on likes.movie_id = movies.id '
                        . 'group by movies.id');
        foreach ($count as $each) {
            //DB::update('update movies set like_num = ? where id = ?', [$each->count, $each->id]);
            \App\Movie::where('id', $each->id)->update(['like_num' => $each->count]);
        }
    }

    protected function ticketCount() {
        $count = DB::select('select movies.id, count(tickets.id) as count
                        from movies 
                        left join schedules on movies.id = schedules.movie_id
                        left join tickets on tickets.schedule_id = schedules.id
                        group by movies.id');
        foreach ($count as $each) {
            //DB::update('update movies set ticket_num = ? where id = ?', [$each->count, $each->id]);
            \App\Movie::where('id', $each->id)->update(['ticket_num' => $each->count]);
        }
    }

    protected function nowplay() {
        $pageTitle = "Phim Đang Chiếu";
        $movies = $this->movieRepository->getNowPlaying(30);
        return view('movies.nowplay', [
            'pageTitle' => $pageTitle,
            'movies' => $movies,
            'movieObj' => $this->movieRepository
        ]);
    }

    protected function comesoon() {
        $pageTitle = "Phim Sắp Chiếu";
        $movies = $this->movieRepository->getCommingSoon(30);
        return view('movies.comesoon', [
            'pageTitle' => $pageTitle,
            'movies' => $movies,
            'movieObj' => $this->movieRepository
        ]);
    }

    protected function like(Request $request) {
        if (Auth::check()) {
            $movieId = $request->movie_id;
            $this->movieRepository->like($movieId);
        }
    }

    protected function unlike(Request $request) {
        if (Auth::check()) {
            $movieId = $request->movie_id;
            $this->movieRepository->unlike($movieId);
        }
    }

    protected function adminNowPlay() {
        $nowplay = $this->movieRepository->getNowPlaying(30);
        $theaterName = \App\Theater::where('status', '=', 1)->get();
        return view('movies.admin_nowplay', [
            'nowplay' => $nowplay,
            'theaterName' => $theaterName
        ]);
    }

    protected function adminComeSoon() {
        $comesoon = $this->movieRepository->getCommingSoon(30);
        $theaterName = \App\Theater::where('status', '=', 1)->get();
        return view('movies.admin_comesoon', [
            'comesoon' => $comesoon,
            'theaterName' => $theaterName
        ]);
    }

    protected function adminAllMovies() {
        $allmovies = $this->movieRepository->getAllMoviesInOrder();
        return view('movies.admin_allmovies', [
            'allmovies' => $allmovies
        ]);
    }

    protected function adminInfo($movieId) {
        $movie = $this->movieRepository->find($movieId);
        return view('movies.admin_info', [
            'movie' => $movie
        ]);
    }

    protected function adminUpdate(Request $request) {
        $this->movieRepository->update($request->id, ['title' => $request->title, 'release_date' => $request->release_date, 
                    'genres' => $request->genres, 'score' => $request->score, 'director' => $request->director, 'country' => $request->country,
                    'length' => $request->length, 'subtitle' => $request->subtitle, 'rating' => $request->rating]);
        return redirect('/admin');
    }

    protected function filterNowPlay(Request $request) {
        $theaterId = $request->theater_id;
        if ($theaterId != -1) {
            $movies = $this->movieRepository->getNowPlayingFilter($theaterId);
        } else {
            $movies = $this->movieRepository->getNowPlaying(30);
        }
        return view('movies.admin_filter', [
            'movies' => $movies,
            'theaterId' => $theaterId,
        ]);
    }

    /*protected function filterComeSoon() {
        if ($theater_id != -1) {
            $movies = $this->movieRepository->getCommingSoonFilter($theaterId);
        } else {
            $movies = $this->movieRepository->getCommingSoon(30);
        }
        return view('movies.admin_filter', [
            'movies' => $movies
        ]);
    }*/

    protected function adminDelete(Request $request) {
        $movieId = $request->movie_id;
        $this->movieRepository->update($movieId, ['status' => 0]);
    }

    protected function addMovie() {
        return view('movies.adminAddMovie');
    }

    protected function add(Request $request) {
        if ($request->hasFile('file')) {
            $file = $request->file;
            $file->move('img', $file->getClientOriginalName());

            $this->movieRepository->create([$request->title, $request->score, $request->director, $request->country,
                $request->release_date, $request->length, $request->subtitle, $request->genres, $request->rating,
                $file->getClientOriginalName(), 1]);
        }
        return redirect('/admin');
    }

}
