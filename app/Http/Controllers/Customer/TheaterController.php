<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TheaterRepository;

class TheaterController extends Controller
{
    protected $theaterRepo;

    public function __construct(TheaterRepository $theaterRepo)
    {
        $this->theaterRepo = $theaterRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pageTitle = "Hệ Thống Rạp";
        $theaters = $this->theaterRepo->getActiveList();
        $movieId = null;
        return view('customer.theater.index', compact('pageTitle', 'theaters', 'movieId'));
    }

    /**
     * Show theater index but only show schedule of only one movie
     * @param $movieId
     */
    protected function indexForOnlyOneMovie($movieId) {
        $pageTitle = "Hệ Thống Rạp";
        $theaters = $this->theaterRepo->getIndexForOnlyOneMovie($movieId);
        return view('customer.theater.index', [
            'pageTitle' => $pageTitle,
            'theaters' => $theaters,
            'movieId' => $movieId,
        ]);
    }

    protected function detail(Request $request) {
        $infoDetail = $this->theaterRepo->find($request->theater_id);
        return view('customer.theater.detail', compact('infoDetail'));
    }

    protected function schedule(Request $request) {
        $scheduleDetail = $this->theaterRepo->getScheduleDetail($request);
        return view('customer.theater.schedule', [
            'schedule' => $scheduleDetail
        ]);
    }

    protected function scheduleForOnlyOneMovie(Request $request) {
        $scheduleDetail = $this->theaterRepo->getScheduleForOnlyOneMovie($request);
        return view('customer.theater.schedule', [
            'schedule' => $scheduleDetail
        ]);
    }

    protected function seatmap($schedule_id) {
        $pageTitle = "Đặt Vé Trực Tuyến";
        $seatmap = $this->theaterRepo->getSeatmap($schedule_id);
        $chosenSeat = \App\Ticket::where('schedule_id', $schedule_id)->select('chair_num')->get();
        $schedule = \App\Schedule::find($schedule_id);
        // die($schedule);
        return view('customer.theater.seatmap', [
            'pageTitle' => $pageTitle,
            'seatmap' => $seatmap,
            'chosenSeat' => $chosenSeat,
            'price' => $schedule->price
        ]);
    }

}
