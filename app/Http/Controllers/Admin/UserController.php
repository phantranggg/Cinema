<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\ScheduleRepository;
use App\Repositories\TheaterRepository;
use App\Repositories\TicketRepository;
use App\Repositories\MovieRepository;
use App\Repositories\UserRepository;
class UserController extends Controller {

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
//    protected function userLike() {
//        $user = \App\User::find(1);
//        foreach ($user->movies as $movie) {
//            echo $role->pivot->created_at;
//        }
//    }
//
//    protected function profile() {
//        $pageTitle = "Thông Tin Người Dùng";
//        $movies = DB::select('SELECT schedules.id, movies.title, theaters.name, schedules.type, schedules.show_date, schedules.show_time '
//                        . 'FROM schedules '
//                        . 'INNER JOIN movies ON schedules.movie_id = movies.id '
//                        . 'INNER JOIN theaters ON schedules.theater_id = theaters.id '
//                        . 'INNER JOIN tickets ON schedules.id = tickets.schedule_id '
//                        . 'WHERE tickets.user_id = ? '
//                        . 'AND show_date >= ? '
//                        . 'GROUP BY schedules.id, movies.title, theaters.name, schedules.show_date, schedules.show_time', [Auth::id(), config('constant.today')]);
//        foreach ($movies as $key => $value) {
//            $tickets = DB::select('SELECT chair_num '
//                            . 'FROM tickets '
//                            . 'WHERE user_id = ? '
//                            . 'AND schedule_id = ? ', [Auth::id(), $value->id]);
//            $value->tickets = $tickets;
//            $movies[$key] = $value;
//        }
//        return view('users.profile', [
//            'pageTitle' => $pageTitle,
//            'movies' => $movies
//        ]);
//    }
//
//    protected function update(Request $request) {
//        if ($request->password === $request->password_confirmation) {
//            DB::update('UPDATE users '
//                    . 'SET password = ?, date_of_birth = ?, phone = ?, address = ? '
//                    . 'WHERE id = ?', [bcrypt($request->password), $request->date_of_birth, $request->phone, $request->address, Auth::id()]);
//        }
//        return redirect('/users/profile');
//    }
//
//    protected function ticketModify($schedule_id) {
//        $pageTitle = "Sửa thông tin vé";
//        $data = DB::select('SELECT movies.*, theaters.*, schedules.* '
//                        . 'FROM schedules '
//                        . 'INNER JOIN movies ON schedules.movie_id = movies.id '
//                        . 'INNER JOIN theaters ON schedules.theater_id = theaters.id '
//                        . 'WHERE schedules.id = ?', [$schedule_id]);
//        $chosenSeat = DB::select('SELECT chair_num FROM tickets WHERE schedule_id = ?', [$schedule_id]);
//        $mySeat = DB::select('SELECT chair_num '
//                        . 'FROM tickets '
//                        . 'WHERE schedule_id = ? '
//                        . 'AND user_id = ?', [$schedule_id, Auth::id()]);
//        $i = 0;
//        $string = "";
//        foreach ($mySeat as $seat) {
//            if ($i++ < count($mySeat) - 1) {
//                $string = $string . $seat->chair_num . ' ';
//            } else {
//                $string = $string . $seat->chair_num;
//            }
//        }
//        $schedule = DB::table('schedules')->where('id', '=', $schedule_id)->first();
//        return view('users.ticket_modify', [
//            'pageTitle' => $pageTitle,
//            'seatmap' => $data,
//            'chosenSeat' => $chosenSeat,
//            'mySeat' => $mySeat,
//            'nowBill' => count($mySeat) * $schedule->price,
//            'price' => $schedule->price,
//            'stringChair' => $string,
//        ]);
//    }
//
//    protected function ticketDelete(Request $request) {
//        $scheduleId = $request->schedule_id;
//        $seats = DB::select('SELECT chair_num '
//                        . 'FROM tickets '
//                        . 'WHERE schedule_id = ? '
//                        . 'AND user_id = ?', [$scheduleId, Auth::id()]);
//        $user = \App\User::find(Auth::id());
//        $schedule = \DB::table('schedules')->find($scheduleId);
//        $tmp = (int) $user->total_amount;
//        foreach ($seats as $seat) {
//            // DB::delete('DELETE FROM tickets WHERE schedule_id = ? AND chair_num = ? AND user_id = ?', [$scheduleId, $seat->chair_num, Auth::id()]);
//            $tmp = $tmp - $schedule->price;
//        }
//        //die(var_dump($tmp));
//        if ($tmp >= 1000000) {
//            \App\User::where('id', Auth::id())->update(['total_amount' => $tmp]);
//        } else {
//            \App\User::where('id', Auth::id())->update(['total_amount' => $tmp, 'account_type' => 'normal']);
//        }
//    }

    protected function show() {
//
        $users = $this->userRepo->getShow();
//        $users = \App\User::orderBy('total_amount', 'desc')->get();
        return view('admin.user.list', [
            'users' => $users,
        ]);
    }

    protected function modify($user_id) {
        $user = $this->userRepo->find($user_id);
//        return 'ahahah';
        return view('admin.user.info', [
            'user' => $user,
        ]);
    }
//
//    //dang chua update thanh cong
    protected function update(Request $request) {
        $this->userRepo->updateAdmin($request->user_id,$request);
        return redirect('/admin/users');
    }


}
