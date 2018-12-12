<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    protected $userRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        // $this->middleware('auth');
        $this->userRepo = $userRepo;
    }
    
    protected function profile() {
        $pageTitle = "Thông Tin Người Dùng";
        $tickets = $this->userRepo->getOrderedTicketList();
        return view('customer.user.profile', [
            'pageTitle' => $pageTitle,
            'tickets' => $tickets
        ]);
    }

    public function update(Request $request) {
        $this->userRepo->update($request, Auth::user()->id);
        return back()->with('success','You have successfully update profile');
    }

    protected function like(Request $request) {
        if (Auth::check()) {
            $this->userRepo->like($request->movie_id);
        }
    }

    protected function unlike(Request $request) {
        if (Auth::check()) {
            $this->userRepo->unlike($request->movie_id);
        }
    }

    protected function bill(Request $request) {
        $this->userRepo->getBill($request);
    }

    protected function ticketModify($schedule_id) {
        $pageTitle = "Sửa thông tin vé";
        $seatmap = DB::select('SELECT movies.*, theaters.*, schedules.* '
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
            'seatmap' => $seatmap,
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
}
