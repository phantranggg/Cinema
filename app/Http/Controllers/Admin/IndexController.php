<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ScheduleRepository;
use App\Repositories\TheaterRepository;
use App\Repositories\TicketRepository;
use App\Repositories\MovieRepository;
use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ticketNum = $this->ticketRepo->count();
        $movieNum = $this->movieRepo->count();
        $theaterNum = $this->theaterRepo->count();
        $userNum = $this->userRepo->count();




        $theaters = $this->theaterRepo->countNumberTicket();
        $schedules = $this->scheduleRepo->statistic();
        $ticketCountByDay = $this->ticketRepo->countByDay();
        $users= $this->userRepo->statitic();

        return view('admin.admin', [
            'theaters' => $theaters,
            'schedules' => $schedules,
            'users' => $users,
            'ticketNum' => $ticketNum,
            'movieNum' => $movieNum,
            'theaterNum' => $theaterNum,
            'userNum' => $userNum,
            'ticketCountByDay' => $ticketCountByDay,
        ]);
    }

    
}
