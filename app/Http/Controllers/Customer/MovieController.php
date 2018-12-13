<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\MovieRepository;

class MovieController extends Controller
{

    protected $movieRepo;

    public function __construct(MovieRepository $movieRepo)
    {
        $this->movieRepo = $movieRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movies = $this->movieRepo->all($request, false);
        die($movies);
        // return view('customer.movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentTypeArr = $this->movieRepo->paymentTypeArr();
        return view('customer.movie.create', compact('paymentTypeArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->movieRepo->rulesCreate());
        if ($validator->fails()) {
            $this->toastrError($validator->errors()->toArray());
            return redirect()->back()->withInput();
        }
        $this->movieRepo->create($request);
        $this->toastrSuccess(trans('customer/base.msg_susscess'));
        return redirect()->route('customer.movie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = $this->movieRepo->find($id);
        if (is_null($movie)) {
            abort(404);
        }
        return view('customer.movie.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = $this->movieRepo->find($id);
        $paymentTypeArr = $this->movieRepo->paymentTypeArr();
        if (is_null($movie)) {
            abort(404);
        }
        return view('customer.movie.edit', compact('movie','paymentTypeArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->movieRepo->rulesUpdate($id));
        if ($validator->fails()) {
            $this->toastrError($validator->errors()->toArray());
            return redirect()->back()->withInput();
        } else {
            $this->movieRepo->update($request, $id);
            $this->toastrSuccess(trans('customer/base.msg_susscess'));
            return redirect()->route('customer.movie.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->movieRepo->delete($id);
        $this->toastrSuccess(trans('customer/base.msg_susscess_delete'));
        return redirect()->back();
    }

    protected function showNowPlayingList() {
        $movies = $this->movieRepo->getNowPlayingList(30);
        return view('customer.movie.nowplay', [
            'pageTitle' => "Phim Đang Chiếu",
            'movies' => $movies,
            'movieObj' => $this->movieRepo
        ]);
    }

    protected function showComingSoonList() {
        $movies = $this->movieRepo->getCommingSoonList(30);
        return view('customer.movie.comesoon', [
            'pageTitle' => "Phim Sắp Chiếu",
            'movies' => $movies,
            'movieObj' => $this->movieRepo
        ]);
    }

    protected function recommend(Request $request) {
        // echo $request->genre;
        // echo $request->year;
        // echo $request->country;
        $pageTitle = "PHIM GỢI Ý";
        // $movies = $this->movieRepository->getNowPlaying(30);
        $allmovies = \App\Movie::all();
        $movies = [];
        // dd($allmovies);
        foreach($allmovies as $movie) {
            // dd($movie->release_date);
            $year = \Carbon\Carbon::createFromFormat('Y-m-d', $movie->release_date)->year;
            if ($request->year != "" && $request->year != $year) {
                continue;
            }
            $genre = $movie->genres;
            $genres = explode(", ", $genre);
            for ($i = 0; $i < count($genres); $i++) {
                if ($genres[$i] === "Hành Động") { $genres[$i] = "action"; }
                if ($genres[$i] === "Tâm Lý") { $genres[$i] = "romance"; }
                if ($genres[$i] === "Tình Cảm") { $genres[$i] = "romance"; }
                if ($genres[$i] === "Kinh Dị") { $genres[$i] = "horror"; }
                if ($genres[$i] === "Phiêu Lưu") { $genres[$i] = "adventure"; }
                if ($genres[$i] === "Khoa Học Viễn Tưởng") { $genres[$i] = "scientific"; }
            }
            $country = $request->country == "usa" ? "USA" : ($request->country == "vie" ? "Việt Nam" : 
                ($request->country == "chi" ? "Trung Quốc" : ($request->country == "kor" ? "Hàn Quốc" : ($request->country == "jap" ? "Nhật Bản" : "")))); 
            if ($country != "" && $country != $movie->country) {
                continue;
            }
            if ($request->genre != "" && !in_array($request->genre, $genres)) {
                continue;
            }
            array_push($movies, $movie);
        }

        return view('customer.movie.recommend', [
            'pageTitle' => $pageTitle,
            'movies' => $movies,
            'movieObj' => $this->movieRepo
        ]);
    }

    protected function search(Request $request) {
        $pageTitle = "TÌM KIẾM PHIM";
        $kw = $request->keyword;
        $data = $this->movieRepo->findByKeyword($kw);
        return view('customer.movie.search', [
            'pageTitle' => $pageTitle,
            'movies' => $data,
            'movieObj' => $this->movieRepo,
            'keyword' => $kw
        ]);
    }
}
