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

    protected function index() {
        $users = $this->userRepo->getShow();
//        $users = \App\User::orderBy('total_amount', 'desc')->get();
        return view('admin.user.list', [
            'users' => $users,
        ]);
    }

    protected function show($user_id) {
        $user = $this->userRepo->find($user_id);
        return view('admin.user.info', [
            'user' => $user,
        ]);
    }

    protected function update(Request $request) {
        $this->userRepo->updateAdmin($request->user_id, $request);
        return redirect()->route('admin.user.index');
    }

    protected function destroy(Request $request) {
        $user_id = $request->user_id;
        $this->userRepo->delete($user_id);
        return 'haha';
        return redirect()->route('admin.user.index');
    }

    protected function create() {
        return view('admin.user.form');
    }

    protected function store(Request $request) {
        $this->userRepo->create($request);

        return redirect('/admin/user/index');
    }

    protected function adminAgeStatistic() {

    }

}
