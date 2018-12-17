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

    private function getMatchNumForSchedule($scheduleDetail){
        foreach ($scheduleDetail as $movie){
            foreach ($movie->schedule_detail as $scheduleInfo){
                $matchNum = $this->scheduleRepo->getMatchNum($scheduleInfo -> id);
                $scheduleInfo->matchNum = $matchNum;
            }
        }
        return $scheduleDetail;
    }


    protected function schedule(Request $request) {
        $scheduleDetail = $this->scheduleRepo->getScheduleDetail($request);
        $this->getMatchNumForSchedule($scheduleDetail);
        return view('customer.schedule.schedule', [
            'schedule' => $scheduleDetail,
        ]);
    }

    protected function scheduleForOnlyOneMovie(Request $request) {
        $scheduleDetail = $this->scheduleRepo->getScheduleForOnlyOneMovie($request);
        $this->getMatchNumForSchedule($scheduleDetail);
        return view('customer.schedule.schedule', [
            'schedule' => $scheduleDetail,
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
        $scheduleId = $schedule_id;
        $users = $this->scheduleRepo->getPairList($scheduleId);
        $hasUserInPairList = $this->scheduleRepo->checkUserInPairList($scheduleId);;
        return view('customer.schedule.pair', compact('scheduleId', 'users', 'hasUserInPairList'));
    }

    // public function joinPair(Request $request) {
    //     $userId1 = $request->user_id1;
    //     $scheduleId = $request->schedule_id;
    //     $this->scheduleRepo->joinPair($userId1, $scheduleId);
    //     $this->showPairList($scheduleId);
    // }

    public function joinPair() {
        $userId1 = $_GET['user_id1'];
        $scheduleId = $_GET['schedule_id'];
        $this->scheduleRepo->joinPair($userId1, $scheduleId);
        $users = $this->scheduleRepo->getPairList($scheduleId);
        $hasUserInPairList = $this->scheduleRepo->checkUser2InPairList($userId1, $scheduleId);
        return view('customer.schedule.pair', compact('scheduleId', 'users', 'hasUserInPairList'));
    }

    public function selfAdd() {
        $userId1 = $_GET['user_id1'];
        $scheduleId = $_GET['schedule_id'];
        $this->scheduleRepo->selfAdd($userId1, $scheduleId);
        return redirect('/schedule/seatmap/'.$scheduleId)->with('status', 'pair-mode');
    }
}