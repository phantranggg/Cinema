<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ScheduleRepository;

class ScheduleController extends Controller
{
    protected $scheduleRepo;

    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepo = $scheduleRepo;
    }


    protected function schedule(Request $request) {
        $scheduleDetail = $this->scheduleRepo->getScheduleDetail($request);
        return view('customer.schedule.schedule', [
            'schedule' => $scheduleDetail
        ]);
    }

    protected function scheduleForOnlyOneMovie(Request $request) {
        $scheduleDetail = $this->scheduleRepo->getScheduleForOnlyOneMovie($request);
        return view('customer.schedule.schedule', [
            'schedule' => $scheduleDetail
        ]);
    }

    public function seatmap($schedule_id) {
        $pageTitle = "Đặt Vé Trực Tuyến";
        $seatmap = $this->scheduleRepo->getSeatmap($schedule_id);
        $chosenSeat = \App\Ticket::where('schedule_id', $schedule_id)->select('chair_num')->get();
        $schedule = \App\Schedule::find($schedule_id);
        return view('customer.schedule.seatmap', [
            'pageTitle' => $pageTitle,
            'seatmap' => $seatmap,
            'chosenSeat' => $chosenSeat,
            'price' => $schedule->price
        ]);
    }

    public function showPairList($schedule_id) {
        $users = $this->scheduleRepo->getPairList($schedule_id);
        return view('customer.schedule.pair', compact('schedule_id', 'users'));
    }

    public function joinPair(Request $request) {
        $userId1 = $request->user_id1;
        $scheduleId = $request->schedule_id;
        $this->scheduleRepo->joinPair($userId1, $scheduleId);
    }

    public function selfAdd() {
        $userId1 = $_GET['user_id1'];
        $scheduleId = $_GET['schedule_id'];
        $this->scheduleRepo->selfAdd($userId1, $scheduleId);
        // $this->seatmap($scheduleId);
        return redirect('/schedule/seatmap/1');
    }
}
