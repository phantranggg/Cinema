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
        $seatmap = DB::select('SELECT movies.*, theaters.*, schedules.* '
                        . 'FROM schedules '
                        . 'INNER JOIN movies ON schedules.movie_id = movies.id '
                        . 'INNER JOIN theaters ON schedules.theater_id = theaters.id '
                        . 'WHERE schedules.id = ?', [$schedule_id]);
        return $seatmap;
    }


}