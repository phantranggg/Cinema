<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller {

    protected function userLike() {
        $user = \App\User::find(1);
        foreach ($user->movies as $movie) {
            echo $role->pivot->created_at;
        }
    }

    protected function profile() {
        $pageTitle = "Thông Tin Người Dùng";
        $movies = DB::select('SELECT schedules.id, movies.title, theaters.name, schedules.type, schedules.show_date, schedules.show_time '
                        . 'FROM schedules '
                        . 'INNER JOIN movies ON schedules.movie_id = movies.id '
                        . 'INNER JOIN theaters ON schedules.theater_id = theaters.id '
                        . 'INNER JOIN tickets ON schedules.id = tickets.schedule_id '
                        . 'WHERE tickets.user_id = ? '
                        . 'AND show_date >= ? '
                        . 'GROUP BY schedules.id, movies.title, theaters.name, schedules.show_date, schedules.show_time', [Auth::id(), config('constant.today')]);
        foreach ($movies as $key => $value) {
            $tickets = DB::select('SELECT chair_num '
                            . 'FROM tickets '
                            . 'WHERE user_id = ? '
                            . 'AND schedule_id = ? ', [Auth::id(), $value->id]);
            $value->tickets = $tickets;
            $movies[$key] = $value;
        }
        return view('users.profile', [
            'pageTitle' => $pageTitle,
            'movies' => $movies
        ]);
    }

    protected function update(Request $request) {
        if ($request->password === $request->password_confirmation) {
            DB::update('UPDATE users '
                    . 'SET password = ?, date_of_birth = ?, phone = ?, address = ? '
                    . 'WHERE id = ?', [bcrypt($request->password), $request->date_of_birth, $request->phone, $request->address, Auth::id()]);
        }
        return redirect('/users/profile');
    }

    protected function ticketModify($schedule_id) {
        $pageTitle = "Sửa thông tin vé";
        $data = DB::select('SELECT movies.*, theaters.*, schedules.* '
                        . 'FROM schedules '
                        . 'INNER JOIN movies ON schedules.movie_id = movies.id '
                        . 'INNER JOIN theaters ON schedules.theater_id = theaters.id '
                        . 'WHERE schedules.id = ?', [$schedule_id]);
        $chosenSeat = DB::select('SELECT chair_num FROM tickets WHERE schedule_id = ?', [$schedule_id]);
        $mySeat = DB::select('SELECT chair_num '
                        . 'FROM tickets '
                        . 'WHERE schedule_id = ? '
                        . 'AND user_id = ?', [$schedule_id, Auth::id()]);
        $i = 0;
        $string = "";
        foreach ($mySeat as $seat) {
            if ($i++ < count($mySeat) - 1) {
                $string = $string . $seat->chair_num . ' ';
            } else {
                $string = $string . $seat->chair_num;
            }
        }
        $schedule = DB::table('schedules')->where('id', '=', $schedule_id)->first();
        return view('users.ticket_modify', [
            'pageTitle' => $pageTitle,
            'seatmap' => $data,
            'chosenSeat' => $chosenSeat,
            'mySeat' => $mySeat,
            'nowBill' => count($mySeat) * $schedule->price,
            'price' => $schedule->price,
            'stringChair' => $string,
        ]);
    }

    protected function ticketDelete(Request $request) {
        $scheduleId = $request->schedule_id;
        $seats = DB::select('SELECT chair_num '
                        . 'FROM tickets '
                        . 'WHERE schedule_id = ? '
                        . 'AND user_id = ?', [$scheduleId, Auth::id()]);
        $user = \App\User::find(Auth::id());
        $schedule = \DB::table('schedules')->find($scheduleId);
        $tmp = (int) $user->total_amount;
        foreach ($seats as $seat) {
            // DB::delete('DELETE FROM tickets WHERE schedule_id = ? AND chair_num = ? AND user_id = ?', [$scheduleId, $seat->chair_num, Auth::id()]);
            $tmp = $tmp - $schedule->price;
        }
        //die(var_dump($tmp));
        if ($tmp >= 1000000) {
            \App\User::where('id', Auth::id())->update(['total_amount' => $tmp]);
        } else {
            \App\User::where('id', Auth::id())->update(['total_amount' => $tmp, 'account_type' => 'normal']);
        }
    }

    protected function adminShow() {
//        $users = DB::select('WITH ticketnum AS
//                            (SELECT tickets.user_id, schedule_id, count(tickets.id) AS num
//                            FROM tickets
//                            GROUP BY tickets.user_id, schedule_id)
//                    SELECT users.*, sum(ticketnum.num * price) AS totalamount
//                    FROM users 
//                    LEFT JOIN ticketnum ON users.id = ticketnum.user_id
//                    LEFT JOIN schedules ON schedules.id = ticketnum.schedule_id
//                    WHERE users.status = 1
//                    GROUP BY users.id
//                    ORDER BY totalamount DESC NULLS LAST');
        $users = \App\User::where('status', '=', 1)->orderBy('total_amount', 'desc')->get();
        return view('users.admin_list', [
            'users' => $users,
        ]);
    }

    protected function adminModify($user_id) {
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$user_id]);
        return view('users.admin_info', [
            'user' => $user,
        ]);
    }

    //dang chua update thanh cong
    protected function adminUpdate(Request $request, $user_id) {
        DB::update('UPDATE users '
                . 'SET date_of_birth = ?, phone = ?, address = ?, account_type = ?, role = ? '
                . 'WHERE id = ?', [$request->date_of_birth, $request->phone, $request->address, $request->account_type, $request->role, $user_id]);
        return redirect('/admin/users');
    }

    protected function adminDelete() {
        $user_id = $_POST['user_id'];
        DB::update('UPDATE users SET status = 0 WHERE id = ?', [$user_id]);
    }

    protected function adminForm() {
        return view('users.admin_form');
    }

    protected function adminInsert(Request $request) {
        if ($request->password === $request->password_confirmation) {
            DB::insert('INSERT INTO users(name, date_of_birth, email, password, phone, address, account_type, role, status) '
                    . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->name, $request->date_of_birth, $request->email,
                bcrypt($request->password), $request->phone, $request->address, $request->account_type, $request->role, 1]);
        }
        return redirect('/admin/users');
    }

    protected function adminAgeStatistic() {
        
    }

}
