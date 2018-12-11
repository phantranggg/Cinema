<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
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

    protected function detail(Request $request) {
        $infoDetail = $this->theaterRepo->find($request->theater_id);
        return view('customer.theater.detail', compact('infoDetail'));
    }

    protected function schedule(Request $request) {
        $movieTitle = DB::select('SELECT DISTINCT movies.id, title, url '
                        . 'FROM movies INNER JOIN schedules '
                        . 'ON movies.id = schedules.movie_id '
                        . 'WHERE theater_id = ?', [$request->theater_id]);
        foreach ($movieTitle as $key => $value) {
            $schedule_detail = DB::select('WITH seatnum AS 
                                (SELECT id, row_num * column_num AS totalseat FROM theaters WHERE status = 1)
                        SELECT schedules.id, show_date, show_time, type, totalseat - count(tickets.id) AS totalseat
                        FROM tickets 
                        RIGHT JOIN schedules ON tickets.schedule_id = schedules.id
                        INNER JOIN seatnum ON schedules.theater_id = seatnum.id
                        WHERE schedules.status = 1
                        AND theater_id = ?
                        AND movie_id = ?
                        GROUP BY schedules.id, seatnum.totalseat
                        ORDER BY show_date ASC, show_time ASC', [$theater_id, $value->id]);
            $value->schedule_detail = $schedule_detail;
            $movieTitle[$key] = $value;
        }
        return view('customer.theater.schedule', [
            'schedule' => $movieTitle
        ]);
    }

    protected function scheduleMovie(Request $request) {
        $theater_id = $request->theater_id;
        $movie_id = $request->movie_id;
        $movieTitle = DB::select('SELECT DISTINCT movies.id, title, url '
                        . 'FROM movies INNER JOIN schedules '
                        . 'ON movies.id = schedules.movie_id '
                        . 'WHERE theater_id = ? '
                        . 'AND movie_id = ?', [$theater_id, $movie_id]);
        foreach ($movieTitle as $key => $value) {
            $scheduleDetail = DB::select('WITH seatnum AS 
                                (SELECT id, row_num * column_num AS totalseat FROM theaters WHERE status = 1)
                        SELECT schedules.id, show_date, show_time, type, totalseat - count(tickets.id) AS totalseat
                        FROM tickets 
                        RIGHT JOIN schedules ON tickets.schedule_id = schedules.id
                        INNER JOIN seatnum ON schedules.theater_id = seatnum.id
                        WHERE schedules.status = 1
                        AND theater_id = ?
                        AND movie_id = ?
                        GROUP BY schedules.id, seatnum.totalseat
                        ORDER BY show_date ASC, show_time ASC', [$theater_id, $value->id]);
            $value->schedule_detail = $scheduleDetail;
            $movieTitle[$key] = $value;
        }
        return view('customer.theater.schedule', [
            'schedule' => $movieTitle
        ]);
    }
}
