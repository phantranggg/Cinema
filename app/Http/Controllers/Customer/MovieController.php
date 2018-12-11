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
        return view('customer.movies.nowplay', [
            'pageTitle' => "Phim Đang Chiếu",
            'movies' => $movies,
            'movieObj' => $this->movieRepo
        ]);
    }

    protected function showComingSoonList() {
        $movies = $this->movieRepo->getNowPlayingList(30);
        return view('customer.movies.comesoon', [
            'pageTitle' => "Phim Sắp Chiếu",
            'movies' => $movies,
            'movieObj' => $this->movieRepo
        ]);
    }
}
