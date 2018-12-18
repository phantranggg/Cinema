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

    protected function index(Request $request) {
        $theaters =  $this->theaterRepo->all($request,false);
        return view('admin.theater.all_theater', [
            'theaters' => $theaters
        ]);
    }

    protected function show($theater_id) {
        $theater = $this->theaterRepo->find($theater_id);
        return view('admin.theater.theater_info', [
            'theater' => $theater
        ]);
    }

    protected function update(Request $request) {
        $this->theaterRepo->update($request);
        return redirect('/admin/theater/index');
    }

    protected function destroy($theater_id) {
        $this->theaterRepo->delete($theater_id);
        return redirect('/admin/theater/index');
    }

    protected function create() {
        return view('admin.theater.add_theater');
    }

    protected function store(Request $request) {
        $this->theaterRepo->create(['name'=>$request->name, 'hotline'=>$request->hostline, 'row_num'=>$request->row_num, 'column_num'=>$request->column_num,
            'fax'=>$request->fax, 'address'=>$request->address, 'status'=>1]);
        return redirect('/admin/theater/index');
    }
}
