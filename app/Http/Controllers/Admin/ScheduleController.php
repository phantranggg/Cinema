<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\MovieRepository;
use App\Repositories\TheaterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ScheduleRepository;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    protected $scheduleRepo;

    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepo = $scheduleRepo;
        $this->theaterRepo = new TheaterRepository(app());
        $this->movieRepo = new MovieRepository(app());

    }


    protected function index(Request $request) {
        $schedules = $this->scheduleRepo->all($request,false);
        $theater_name= $this->theaterRepo->getAllName();
        return view('admin.schedule.index', [
            'schedules' => $schedules,
            'theater_name' => $theater_name
        ]);
    }
    protected function filter(Request $request){
            $theater_id = (int)$request->theater_id;
            $schedules=$this->scheduleRepo->filterTheater($theater_id);
            return view('admin.schedule.filter', [
                'schedules' => $schedules
            ]);
    }


    protected function create(Request $request) {
        $theaters = $this->theaterRepo->all($request);
        $movies = $this->movieRepo->all($request);
        return view('admin.schedule.create', [
            'theaters' => $theaters,
            'movies' => $movies
        ]);
    }
    protected function store(Request $request) {
        $this->scheduleRepo->create($request);
        return redirect()->route('admin.schedule.index');
    }


    protected function destroy($schedule_id) {
        $this->scheduleRepo->delete($schedule_id);
        return redirect()->route('admin.schedule.index');
    }


}
