<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Theater;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Repositories\ScheduleRepository;
use App\Repositories\TheaterRepository;
use App\Repositories\TicketRepository;
use App\Repositories\MovieRepository;
use App\Repositories\UserRepository;
use phpDocumentor\Reflection\Types\Null_;

class TheaterController extends Controller {

    protected $movieRepo;
    protected $scheduleRepo;
    protected $theaterRepo;
    protected $ticketRepo;
    protected $userRepo;

    public function __construct() {
        $this->movieRepo=new MovieRepository(app());
        $this->scheduleRepo = new ScheduleRepository(app());
        $this->theaterRepo = new TheaterRepository(app());
        $this->ticketRepo = new TicketRepository(app());
        $this->userRepo = new UserRepository(app());
    }

//    protected function index() {
//        $pageTitle = "Hệ Thống Rạp";
//        $theaters = DB::select('SELECT id,name FROM theaters WHERE status = 1');
//        return view('theaters.index', [
//            'pageTitle' => $pageTitle,
//            'theaters' => $theaters,
//            'movieId' => null,
//        ]);
//    }

//    protected function indexMovie($movieId) {
//        $pageTitle = "Hệ Thống Rạp";
//        $theaters = DB::select('SELECT DISTINCT theaters.id,name FROM theaters '
//                        . 'INNER JOIN schedules ON theaters.id = schedules.theater_id '
//                        . 'WHERE movie_id = ? '
//                        . 'AND theaters.status = 1 '
//                        . 'AND schedules.status = 1', [$movieId]);
//        return view('theaters.index', [
//            'pageTitle' => $pageTitle,
//            'theaters' => $theaters,
//            'movieId' => $movieId,
//        ]);
//    }

//    protected function detail() {
//        $theater_id = (int) $_POST['theater_id'];
//        $data = DB::select('SELECT * FROM theaters WHERE id = ?', [$theater_id]);
//        return view('theaters.detail')->with('infoDetail', $data);
//    }

//    protected function schedule() {
//        $theater_id = (int) $_POST['theater_id'];
//        $movieTitle = DB::select('SELECT DISTINCT movies.id, title, url '
//                        . 'FROM movies INNER JOIN schedules '
//                        . 'ON movies.id = schedules.movie_id '
//                        . 'WHERE theater_id = ?', [$theater_id]);
//        foreach ($movieTitle as $key => $value) {
//            $schedule_detail = DB::select('WITH seatnum AS
//                                (SELECT id, row_num * column_num AS totalseat FROM theaters WHERE status = 1)
//                        SELECT schedules.id, show_date, show_time, type, totalseat - count(tickets.id) AS totalseat
//                        FROM tickets
//                        RIGHT JOIN schedules ON tickets.schedule_id = schedules.id
//                        INNER JOIN seatnum ON schedules.theater_id = seatnum.id
//                        WHERE schedules.status = 1
//                        AND theater_id = ?
//                        AND movie_id = ?
//                        GROUP BY schedules.id, seatnum.totalseat
//                        ORDER BY show_date ASC, show_time ASC', [$theater_id, $value->id]);
//            $value->schedule_detail = $schedule_detail;
//            $movieTitle[$key] = $value;
//        }
//        return view('theaters.schedule', [
//            'schedule' => $movieTitle
//        ]);
//    }

//    protected function scheduleMovie(Request $request) {
//        $theater_id = $request->theater_id;
//        $movie_id = $request->movie_id;
//        $movieTitle = DB::select('SELECT DISTINCT movies.id, title, url '
//                        . 'FROM movies INNER JOIN schedules '
//                        . 'ON movies.id = schedules.movie_id '
//                        . 'WHERE theater_id = ? '
//                        . 'AND movie_id = ?', [$theater_id, $movie_id]);
//        foreach ($movieTitle as $key => $value) {
//            $scheduleDetail = DB::select('WITH seatnum AS
//                                (SELECT id, row_num * column_num AS totalseat FROM theaters WHERE status = 1)
//                        SELECT schedules.id, show_date, show_time, type, totalseat - count(tickets.id) AS totalseat
//                        FROM tickets
//                        RIGHT JOIN schedules ON tickets.schedule_id = schedules.id
//                        INNER JOIN seatnum ON schedules.theater_id = seatnum.id
//                        WHERE schedules.status = 1
//                        AND theater_id = ?
//                        AND movie_id = ?
//                        GROUP BY schedules.id, seatnum.totalseat
//                        ORDER BY show_date ASC, show_time ASC', [$theater_id, $value->id]);
//            $value->schedule_detail = $scheduleDetail;
//            $movieTitle[$key] = $value;
//        }
//        return view('theaters.schedule', [
//            'schedule' => $movieTitle
//        ]);
//    }

//    protected function seatmap($schedule_id) {
//        $pageTitle = "Đặt Vé Trực Tuyến";
//        $data = DB::select('SELECT movies.*, theaters.*, schedules.* '
//                        . 'FROM schedules '
//                        . 'INNER JOIN movies ON schedules.movie_id = movies.id '
//                        . 'INNER JOIN theaters ON schedules.theater_id = theaters.id '
//                        . 'WHERE schedules.id = ?', [$schedule_id]);
//        $chosenSeat = DB::select('SELECT chair_num FROM tickets WHERE schedule_id = ?', [$schedule_id]);
//
//        $schedule = DB::table('schedules')->where('id', '=', $schedule_id)->first();
//        return view('theaters.seatmap', [
//            'pageTitle' => $pageTitle,
//            'seatmap' => $data,
//            'chosenSeat' => $chosenSeat,
//            'price' => $schedule->price
//        ]);
//    }
//
//    protected function updateTotalAmount() {
//        \DB::table('users')->update(['total_amount' => 0]);
//        $tickets = \DB::table('tickets')->get();
//        foreach ($tickets as $ticket) {
//            $user = \App\User::find($ticket->user_id);
//            $schedule = \DB::table('schedules')->find($ticket->schedule_id);
//            $tmp = (int) $user->total_amount + (int) $schedule->price;
//            \App\User::where('id', $ticket->user_id)->update(['total_amount' => $tmp]);
//
//            if ($tmp >= 1000000) {
//                \App\User::where('id', $ticket->user_id)->update(['total_amount' => $tmp, 'account_type' => 'vip']);
//            } else {
//                \App\User::where('id', $ticket->user_id)->update(['total_amount' => $tmp, 'account_type' => 'normal']);
//            }
//        }
//    }

//    protected function bill(Request $request) {
//        $seatList = $request->seat_list;
//        $scheduleId = $request->schedule_id;
//        foreach ($seatList as $seat) {
//            //$exist = \DB::table('tickets')->where('schedule_id', $scheduleId)->where('chair_num', $seat);
//            $exist = DB::select('SELECT id FROM tickets WHERE schedule_id = ? AND chair_num = ?', [$scheduleId, $seat]);
//            if (!$exist) {
//                //DB::insert('INSERT INTO tickets(schedule_id, user_id, chair_num) VALUES (?,?,?)', [$scheduleId, Auth::id(), $seat]);
//                DB::table('tickets')->insert(
//                        ['schedule_id' => $scheduleId, 'user_id' => Auth::id(), 'chair_num' => $seat]
//                );
//                $user = \App\User::find(Auth::id());
//                $schedule = \DB::table('schedules')->find($scheduleId);
//                $tmp = (int) $user->total_amount + (int) $schedule->price;
//                \App\User::where('id', Auth::id())->update(['total_amount' => $tmp]);
//                if ($tmp >= 1000000) {
//                    \App\User::find(Auth::id())->update(['account_type' => 'vip']);
//                } else {
//                    \App\User::find(Auth::id())->update(['account_type' => 'normal']);
//                }
//            }
//        }
//    }

//    protected function ticketDelete(Request $request) {
//        $scheduleId = $request->schedule_id;
//        $seatNum = $request->seat_num;
//        DB::delete('DELETE FROM tickets WHERE schedule_id = ? AND user_id = ? AND chair_num = ?', [$scheduleId, Auth::id(), $seatNum]);
//        $user = \App\User::find(Auth::id());
//        $schedule = \DB::table('schedules')->find($scheduleId);
//        $tmp = (int) $user->total_amount - (int) $schedule->price;
//        \App\User::where('id', Auth::id())->update(['total_amount' => $tmp]);
//        if ($tmp >= 1000000) {
//            \App\User::find(Auth::id())->update(['account_type' => 'vip']);
//        } else {
//            \App\User::find(Auth::id())->update(['account_type' => 'normal']);
//        }
//    }

    protected function all(Request $request) {
//        $theaters = DB::select('SELECT * FROM theaters WHERE status = ? ORDER BY id', [1]);
        $theaters =  $this->theaterRepo->all($request,false);
        return view('admin.theater.all_theater', [
            'theaters' => $theaters
        ]);
    }

//    protected function info($theater_id) {
////        $theater = DB::select('SELECT * FROM theaters WHERE id = ?', [$theater_id]);
//        $theater = $this->theaterRepo->find($theater_id);
//        return view('theaters.adminTheaterInfo', [
//            'theater' => $theater
//        ]);
//    }
//
//    protected function update(Request $request) {
//        DB::update('UPDATE theaters '
//                . 'SET name = ?, hotline = ?, row_num = ?, column_num = ?, fax = ?, '
//                . 'address = ?'
//                . 'WHERE id = ?', [$request->name, $request->hotline, $request->row_num, $request->column_num,
//            $request->fax, $request->address, $request->id]);
//        return redirect('/admin/theaters/all');
//    }
//
    protected function delete($theater_id) {
//        DB::update('UPDATE theaters '
//                . 'SET status = 0'
//                . 'WHERE id = ?', [$theater_id]);
        $this->theaterRepo->delete($theater_id);
        return redirect('/admin/theaters/all');
    }

    protected function addTheater() {
        return view('admin.theater.add_theater');
    }

    protected function add(Request $request) {
//        DB::insert('INSERT INTO theaters (name, hotline, row_num, column_num, fax, address, status)
//                VALUES (?,?,?,?,?,?,?)', [$request->name, $request->hotline, $request->row_num, $request->column_num,
//            $request->fax, $request->address, 1]);
        $this->theaterRepo->create(['name'=>$request->name, 'hotline'=>$request->hostline, 'row_num'=>$request->row_num, 'column_num'=>$request->column_num,
            'fax'=>$request->fax, 'address'=>$request->address, 'status'=>1]);
        return redirect('/admin/theaters/all');
    }

//    protected function Detail() {
////        $theaters = DB::select('SELECT name,count(*)
////                FROM theaters LEFT JOIN schedules ON (theaters.id = schedules.theater_id)
////                              JOIN tickets ON (schedules.id = tickets.schedule_id)
////                GROUP BY theaters.id');
//        $theaters = $this->theaterRepo->find()
//        return view('theaters.adminTheaterDetail', [
//            'theaters' => $theaters
//        ]);
//    }



//    protected function ScheduleInfo($schedule_id) {
//        $schedule = DB::select('SELECT schedules.*,title,name
//                FROM schedules JOIN theaters ON (theaters.id = schedules.theater_id)
//                            JOIN movies ON (movies.id = schedules.movie_id)
//                WHERE schedules.id = ?
//                ORDER BY show_date', [$schedule_id]);
//        $theaters = DB::select('SELECT id,name FROM theaters WHERE status = ? ORDER BY id', [1]);
//        $movies = DB::select('SELECT id,title FROM movies WHERE status = ? ORDER BY id', [1]);
//        return view('theaters.adminScheduleInfo', [
//            'schedule' => $schedule,
//            'theaters' => $theaters,
//            'movies' => $movies
//        ]);
//    }
//
//    protected function UpdateSchedule(Request $request) {
//        DB::update('UPDATE schedules '
//                . 'SET movie_id = ?, theater_id = ?, type = ?, show_time = ?, show_date = ?, '
//                . 'price = ?'
//                . 'WHERE id = ?', [$request->movie_id, $request->theater_id, $request->type, $request->show_time,
//            $request->show_date, $request->price, $request->id]);
//        return redirect('/admin/schedules/all');
//    }
//
//    protected function adminFilter() {
//        $theater_id = (int) $_POST['theater_id'];
//        if ($theater_id != -1) {
//            $schedules = DB::select('SELECT schedules.*,title,name
//                        FROM schedules JOIN theaters ON (theaters.id = schedules.theater_id)
//                                    JOIN movies ON (movies.id = schedules.movie_id)
//                        WHERE schedules.status = 1 AND theater_id = ?
//                        ORDER BY show_date', [$theater_id]);
//        } else {
//            $schedules = DB::select('SELECT schedules.id,title,name,type,show_time,show_date,price
//                        FROM schedules JOIN theaters ON (theaters.id = schedules.theater_id)
//                                    JOIN movies ON (movies.id = schedules.movie_id)
//                        WHERE schedules.status = 1
//                        ORDER BY show_date');
//        }
//        return view('theaters.adminFilter', [
//            'schedules' => $schedules
//        ]);
//    }
//
//    protected function adminScheduleDetail() {
//        $schedules = DB::select("SELECT count(schedule_id),
//                        case    when date_part('hour', show_time) = 8 then 1
//                            when date_part('hour', show_time) = 9 then 1
//                            when date_part('hour', show_time) = 10 then 1
//                            when date_part('hour', show_time) = 11 then 1
//                            when date_part('hour', show_time) = 12 then 2
//                            when date_part('hour', show_time) = 13 then 2
//                            when date_part('hour', show_time) = 14 then 2
//                            when date_part('hour', show_time) = 15 then 2
//                            when date_part('hour', show_time) = 16 then 3
//                            when date_part('hour', show_time) = 17 then 3
//                            when date_part('hour', show_time) = 18 then 3
//                            when date_part('hour', show_time) = 19 then 3
//                            when date_part('hour', show_time) = 20 then 4
//                            when date_part('hour', show_time) = 21 then 4
//                            when date_part('hour', show_time) = 22 then 4
//                            when date_part('hour', show_time) = 23 then 4
//                        end
//                    from tickets, schedules
//                    where schedule_id = schedules.id
//                    group by case   when date_part('hour', show_time) = 8 then 1
//                            when date_part('hour', show_time) = 9 then 1
//                            when date_part('hour', show_time) = 10 then 1
//                            when date_part('hour', show_time) = 11 then 1
//                            when date_part('hour', show_time) = 12 then 2
//                            when date_part('hour', show_time) = 13 then 2
//                            when date_part('hour', show_time) = 14 then 2
//                            when date_part('hour', show_time) = 15 then 2
//                            when date_part('hour', show_time) = 16 then 3
//                            when date_part('hour', show_time) = 17 then 3
//                            when date_part('hour', show_time) = 18 then 3
//                            when date_part('hour', show_time) = 19 then 3
//                            when date_part('hour', show_time) = 20 then 4
//                            when date_part('hour', show_time) = 21 then 4
//                            when date_part('hour', show_time) = 22 then 4
//                            when date_part('hour', show_time) = 23 then 4
//                        end
//
//                    order by (count(schedule_id)) DESC");
//        return view('theaters.adminScheduleDetail', [
//            'schedules' => $schedules
//        ]);
//    }
//
//    protected function testChart() {
//        $theaters = \App\Theater::all();
//        return view('test', compact('theaters'), [
//            'theaters' => $theaters
//        ]);
//    }
    
}
