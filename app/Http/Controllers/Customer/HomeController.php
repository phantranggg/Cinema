<?php

namespace App\Http\Controllers\Backend;

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
    public function index()
    {
        $countmovie = $this->movieRepo->count();
        $countInvoice = $this->invoiceRepo->count();
        $countRevenue = $this->revenueRepo->sum();
        return view('backend/index', compact('countmovie','countInvoice','countRevenue'));
    }
}
