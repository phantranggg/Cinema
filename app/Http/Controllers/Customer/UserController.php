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

    public function acceptInvitation(Request $request) {
        $invitationId = $request->invitation_id;
        $this->userRepo->acceptInvitation($invitationId);
        return auth()->user()->unreadNotifications->count();
    }

    public function declineInvitation(Request $request) {
        $invitationId = $request->invitation_id;
        $this->userRepo->declineInvitation($invitationId);
        return auth()->user()->unreadNotifications->count();
    }
}
