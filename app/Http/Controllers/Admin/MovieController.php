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

    public function __construct(MovieRepository $movieRepository) {
        $this->movieRepo = $movieRepository;
        $this->scheduleRepo = new ScheduleRepository(app());
        $this->theaterRepo = new TheaterRepository(app());
    }
//
//    protected function likeCount() {
//        $count = \DB::select('select movies.id, count(likes.id) as count '
//                        . 'from likes right join movies '
//                        . 'on likes.movie_id = movies.id '
//                        . 'group by movies.id');
//        foreach ($count as $each) {
//            //DB::update('update movies set like_num = ? where id = ?', [$each->count, $each->id]);
//            \App\Movie::where('id', $each->id)->update(['like_num' => $each->count]);
//        }
//    }
//
//    protected function ticketCount() {
//        $count = DB::select('select movies.id, count(tickets.id) as count
//                        from movies
//                        left join schedules on movies.id = schedules.movie_id
//                        left join tickets on tickets.schedule_id = schedules.id
//                        group by movies.id');
//        foreach ($count as $each) {
//            //DB::update('update movies set ticket_num = ? where id = ?', [$each->count, $each->id]);
//            \App\Movie::where('id', $each->id)->update(['ticket_num' => $each->count]);
//        }
//    }
//
//    protected function nowplay() {
//        $pageTitle = "Phim Đang Chiếu";
//        $movies = $this->movieRepo->getNowPlaying(30);
//        return view('movies.nowplay', [
//            'pageTitle' => $pageTitle,
//            'movies' => $movies,
//            'movieObj' => $this->movieRepo
//        ]);
//    }
//
//    protected function comesoon() {
//        $pageTitle = "Phim Sắp Chiếu";
//        $movies = $this->movieRepo->getCommingSoon(30);
//        return view('movies.comesoon', [
//            'pageTitle' => $pageTitle,
//            'movies' => $movies,
//            'movieObj' => $this->movieRepo
//        ]);
//    }
//
//    protected function like(Request $request) {
//        if (Auth::check()) {
//            $movieId = $request->movie_id;
//            $this->movieRepo->like($movieId);
//        }
//    }
//
//    protected function unlike(Request $request) {
//        if (Auth::check()) {
//            $movieId = $request->movie_id;
//            $this->movieRepo->unlike($movieId);
//        }
//    }

    protected function nowPlay() {
        $nowplay = $this->movieRepo->getNowPlayingList(12);
        $theaterName = $this->theaterRepo->getActiveList();
        return view('admin.movie.nowplay', [
            'nowplay' => $nowplay,
            'theaterName' => $theaterName
        ]);
    }

    protected function comeSoon() {


//        return $start;

//        return date('Y-m-d',config('constant.today'));
        $comesoon = $this->movieRepo->getCommingSoonList(12);
        $theaterName = \App\Theater::where('status', '=', 1)->get();
        return view('admin.movie.comesoon', [
            'comesoon' => $comesoon,
            'theaterName' => $theaterName
        ]);
    }

    protected function allMovies() {
        $allmovies = $this->movieRepo->getAllMoviesInOrder();
        return view('admin.movie.allmovies', [
            'allmovies' => $allmovies
        ]);
    }

    protected function info($movieId) {
        $movie = $this->movieRepo->find($movieId);
        return view('admin.movie.info', [
            'movie' => $movie
        ]);
    }

    protected function update(Request $request) {

        $this->movieRepo->update_array($request->id, ['title' => $request->title, 'release_date' => $request->release_date,
                    'genres' => $request->genres, 'score' => $request->score, 'director' => $request->director, 'country' => $request->country,
                    'length' => $request->length, 'subtitle' => $request->subtitle, 'rating' => $request->rating]);
        $movie=$this->movieRepo->update($request,$request->id);
        return view('admin.movie.info', [
            'movie' => $movie
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

    protected function delete(Request $request) {
//        return 'hahah';
        $movieId = $request->movie_id;
//        return 'hahah';
        $this->movieRepo->update_array($movieId, ['status' => 0]);
        return 'hahah';
    }

    protected function addMovie() {
        return view('admin.movie.add_movie');
    }

    protected function add(Request $request) {
        if ($request->hasFile('file')) {
            $file = $request->file;
            $file->move('img', $file->getClientOriginalName());

            $this->movieRepo->create($request);

//            $this->movieRepository->create([$request->title, $request->score, $request->director, $request->country,
//                $request->release_date, $request->length, $request->subtitle, $request->genres, $request->rating,
//                $file->getClientOriginalName(), 1]);
        }
        return redirect('/admin');
    }

//    protected function recommendMovies(Request $request) {
//        // echo $request->genre;
//        // echo $request->year;
//        // echo $request->country;
//        $pageTitle = "PHIM GỢI Ý";
//        // $movies = $this->movieRepository->getNowPlaying(30);
//        $allmovies = Movie::all();
//        $movies = [];
//        // dd($allmovies);
//        foreach($allmovies as $movie) {
//            // dd($movies->release_date);
//            $year = Carbon::createFromFormat('Y-m-d', $movie->release_date)->year;
//            if ($request->year != "" && $request->year != $year) {
//                continue;
//            }
//            $genre = $movie->genres;
//            $genres = explode(", ", $genre);
//            for ($i = 0; $i < count($genres); $i++) {
//                if ($genres[$i] === "Hành Động") { $genres[$i] = "action"; }
//                if ($genres[$i] === "Tâm Lý") { $genres[$i] = "romance"; }
//                if ($genres[$i] === "Tình Cảm") { $genres[$i] = "romance"; }
//                if ($genres[$i] === "Kinh Dị") { $genres[$i] = "horror"; }
//                if ($genres[$i] === "Phiêu Lưu") { $genres[$i] = "adventure"; }
//                if ($genres[$i] === "Khoa Học Viễn Tưởng") { $genres[$i] = "scientific"; }
//            }
//            $country = $request->country == "usa" ? "USA" : ($request->country == "vie" ? "Việt Nam" :
//                ($request->country == "chi" ? "Trung Quốc" : ($request->country == "kor" ? "Hàn Quốc" : ($request->country == "jap" ? "Nhật Bản" : ""))));
//            if ($country != "" && $country != $movie->country) {
//                continue;
//            }
//            if ($request->genre != "" && !in_array($request->genre, $genres)) {
//                continue;
//            }
//            array_push($movies, $movie);
//        }
//
//        return view('movies.recommend', [
//            'pageTitle' => $pageTitle,
//            'movies' => $movies,
//            'movieObj' => $this->movieRepo
//        ]);
//    }
}
