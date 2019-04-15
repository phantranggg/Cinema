<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\ScheduleRepository;
use App\Repositories\TheaterRepository;
use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\MovieRepository;
use Carbon\Carbon;

class MovieController extends Controller {

    protected $movieRepo;
    protected $scheduleRepo;
    protected $theaterRepo;

    public function __construct(MovieRepository $movieRepo, ScheduleRepository $scheduleRepo, TheaterRepository $theaterRepo) {
        $this->movieRepo = $movieRepo;
        $this->scheduleRepo = $scheduleRepo;
        $this->theaterRepo = $theaterRepo;
    }
    protected function nowPlay() {
        $nowplay = $this->movieRepo->getNowPlayingList(12);
        $theaterName = $this->theaterRepo->getActiveList();
        return view('admin.movie.nowplay', [
            'nowplay' => $nowplay,
            'theaterName' => $theaterName
        ]);
    }

    protected function comeSoon() {
        $comesoon = $this->movieRepo->getCommingSoonList(12);
        $theaterName = \App\Theater::where('status', '=', 1)->get();
        return view('admin.movie.comesoon', [
            'comesoon' => $comesoon,
            'theaterName' => $theaterName
        ]);
    }

    protected function index() {
        $allmovies = $this->movieRepo->getAllMoviesInOrder(12);
        return view('admin.movie.index', [
            'allmovies' => $allmovies
        ]);
    }
    protected function filterNowPlay(Request $request) {

        $theaterId = $request->theater_id;
        if ($theaterId != -1) {
            $movies = $this->movieRepo->getNowPlayingFilter($theaterId);
        } else {
            $movies = $this->movieRepo->getNowPlayingList(30);
        }
        return view('admin.movie.filter', [
            'movies' => $movies,
            'theaterId' => $theaterId,
        ]);
    }

    protected function show($movie_id) {
        $movie = $this->movieRepo->find($movie_id);
        return view('admin.movie.show', [
            'movie' => $movie
        ]);
    }
    protected function edit(){

    }
    protected function update(Request $request) {

        $this->movieRepo->update_array($request->id, ['title' => $request->title, 'release_date' => $request->release_date,
                    'genres' => $request->genres, 'score' => $request->score, 'director' => $request->director, 'country' => $request->country,
                    'length' => $request->length, 'subtitle' => $request->subtitle, 'rating' => $request->rating]);
        $movie=$this->movieRepo->update($request,$request->id);
        return view('admin.movie.show', [
            'movie' => $movie
        ]);

    }
    protected function destroy(Request $request) {
        $movieId = $request->movie_id;
        $this->movieRepo->update_array($movieId, ['status' => 0]);
    }

    protected function create() {
        return view('admin.movie.create');
    }

    protected function store(Request $request) {
        if ($request->hasFile('file')) {
            $file = $request->file;
            $file->move('img', $file->getClientOriginalName());

            $this->movieRepo->create($request);
        }
        return redirect()->route('admin.movie.index');
    }


}
