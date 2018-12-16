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


    protected function adminScheduleAll(Request $request) {
        $schedules = $this->scheduleRepo->all($request,false);
        $theater_name = DB::select('SELECT id,name FROM theaters');
        return view('admin.theater.adminAllSchedule', [
            'schedules' => $schedules,
            'theater_name' => $theater_name
        ]);
    }


    protected function adminAddSchedule(Request $request) {
        $theaters = $this->theaterRepo->all($request);
        $movies = $this->movieRepo->all($request);

        return view('admin.theater.adminAddSchedule', [
            'theaters' => $theaters,
            'movies' => $movies
        ]);
    }
    protected function adminAddSche(Request $request) {
        $this->scheduleRepo->create($request);
        return redirect()->route('admin.AllSchedule');
    }


    protected function adminDeleteSchedule($schedule_id) {
        $this->scheduleRepo->delete($schedule_id);
        return redirect('/admin/schedules/all');
    }


}
