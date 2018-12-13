<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\MovieRepository;

class HomeController extends Controller
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
    public function index() {
        $pageTitle = "Trang Chủ";
        $movieObj = $this->movieRepo;
        $nowplay = $this->movieRepo->getNowPlayingList(6);
        $comesoon = $this->movieRepo->getCommingSoonList(6);
        return view('customer.home', compact('pageTitle', 'movieObj', 'nowplay','comesoon'));
    }
}
