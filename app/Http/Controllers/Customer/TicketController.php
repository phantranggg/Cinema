<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;

class TicketController extends Controller
{
    protected $ticketRepo;
    
    public function __construct(TicketRepository $ticketRepo)
    {
        $this->ticketRepo = $ticketRepo;
    }

    // public function insertSeat(Request $request) {
    //     $seatNum = $request->seat_num;
    //     $scheduleId = $request->schedule_id;
    //     DB::insert('INSERT INTO tickets (schedule_id, user_id, chair_num) VALUES (?, ?, ?)', [$scheduleId, Auth::id(), $seatNum]);
    // }

    // public function deleteSeat(Request $request) {
    //     die("hihi");
    //     $seatNum = $request->seat_num;
    //     $scheduleId = $request->schedule_id;
    //     DB::delete('DELETE FROM tickets WHERE schedule_id = ? AND chair_num = ?', [$scheduleId, $seatNum]);
    // }

    protected function modify($schedule_id) {
        $pageTitle = "Sửa thông tin vé";
        $seatmap = $this->ticketRepo->getSeatMap($schedule_id);
        $chosenSeat = \App\Ticket::where('schedule_id', $schedule_id)->select('chair_num')->get();
        $mySeat = \App\Ticket::where([['schedule_id', $schedule_id],['user_id', Auth::id()]])->select('chair_num')->get();
        $i = 0;
        $string = "";
        foreach ($mySeat as $seat) {
            if ($i++ < count($mySeat) - 1) {
                $string = $string . $seat->chair_num . ' ';
            } else {
                $string = $string . $seat->chair_num;
            }
        }
        $schedule = DB::table('schedules')->where('id', '=', $schedule_id)->first();
        return view('customer.ticket.modify', [
            'pageTitle' => $pageTitle,
            'seatmap' => $seatmap,
            'chosenSeat' => $chosenSeat,
            'mySeat' => $mySeat,
            'nowBill' => count($mySeat) * $schedule->price,
            'price' => $schedule->price,
            'stringChair' => $string,
        ]);
    }

    public function update() {

    }

    protected function delete(Request $request) {
        $scheduleId = $request->schedule_id;
        $seats = \App\Ticket::where([['schedule_id', $scheduleId],['user_id', Auth::id()]])->select('chair_num')->get();
        foreach ($seats as $seat) {
            DB::delete('DELETE FROM tickets WHERE schedule_id = ? AND chair_num = ? AND user_id = ?', [$scheduleId, $seat->chair_num, Auth::id()]);
        }
    }
}
