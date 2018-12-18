<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Repositories\Support\SAbstractRepository;
use App\Ticket;

class TicketRepository extends SAbstractRepository
{
    /**
     * Define primary model in this repository.
     * @return string
     */
    public function model()
    {
        return 'App\Ticket';
    }

    public function getSeatMap($schedule_id) {
        $seatmap = DB::select('SELECT movie.*, theaters.*, schedules.* '
                        . 'FROM schedules '
                        . 'INNER JOIN movie ON schedules.movie_id = movie.id '
                        . 'INNER JOIN theaters ON schedules.theater_id = theaters.id '
                        . 'WHERE schedules.id = ?', [$schedule_id]);
        return $seatmap;
    }

    public function count(){
//        return DB::select('SELECT count(*) FROM tickets');
        return $this->model->count();
    }
    public function countByDay(){
        return DB::select('select show_date, count(tickets.id) as count
                                from tickets right join schedules on tickets.schedule_id = schedules.id 
                                group by show_date
                                order by show_date;');
    }
}