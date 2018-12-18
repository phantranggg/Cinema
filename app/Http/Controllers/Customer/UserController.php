<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

    protected function update(Request $request) {
        $this->userRepo->update($request);
        return redirect('/user/profile');
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

    protected function ticketDelete(Request $request)
    {
        $scheduleId = $request->schedule_id;
        $seats = DB::select('SELECT chair_num '
            . 'FROM tickets '
            . 'WHERE schedule_id = ? '
            . 'AND user_id = ?', [$scheduleId, Auth::id()]);
        $user = \App\User::find(Auth::id());
        $schedule = \DB::table('schedules')->find($scheduleId);
        $tmp = (int)$user->total_amount;
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
    public function acceptInvitation(Request $request) {
        $invitationId = $request->invitation_id;
        $this->userRepo->acceptInvitation($invitationId);
    }

    public function declineInvitation(Request $request) {
        $invitationId = $request->invitation_id;
        $this->userRepo->declineInvitation($invitationId);
    }
}
