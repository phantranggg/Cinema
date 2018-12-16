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


    protected function scheduleAll(Request $request) {
        $schedules = $this->scheduleRepo->all($request,false);
//        $theater_name = DB::select('SELECT id,name FROM theaters');
        $theater_name= $this->theaterRepo->getAllName();
        return view('admin.schedule.all_schedule', [
            'schedules' => $schedules,
            'theater_name' => $theater_name
        ]);
    }


    protected function addSchedule(Request $request) {
        $theaters = $this->theaterRepo->all($request);
        $movies = $this->movieRepo->all($request);

        return view('admin.schedule.add_schedule', [
            'theaters' => $theaters,
            'movies' => $movies
        ]);
    }
    protected function addSche(Request $request) {
        $this->scheduleRepo->create($request);
        return redirect()->route('admin.AllSchedule');
    }


    protected function deleteSchedule($schedule_id) {
        $this->scheduleRepo->delete($schedule_id);
        return redirect('/admin/schedules/all');
    }


}
