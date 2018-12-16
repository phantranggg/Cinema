<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Support\SAbstractRepository;
use App\Schedule;

class ScheduleRepository extends SAbstractRepository
{

    const SORT_BY_ARR = ['DESC', 'ASC'];
    const ORDER_BY = 'id';

    /**
     * Define primary model in this repository.
     * @return string
     */
    public function model()
    {
        return 'App\Schedule';
    }

    /**
     * Rules create.
     * @return array
     */
    public function rulesCreate()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:schedules,email,NULL,id,deleted_at,NULL',
            'password' => 'required|min:4',
            'avatar' => 'max:4096|mimes:png,jpg,jpeg,gif'
        ];
    }

    /**
     * Rules update.
     * @return array
     */
    public function rulesUpdate($id)
    {
        $rules = $this->rulesCreate();
        $rules['email'] = "required|email|unique:schedules,email,$id,id,deleted_at,NULL";
        $rules['password'] = 'min:4';
        return $rules;
    }

    /**
     * Find a schedule
     * @param int $scheduleId
     * @return Schedule
     */
    public function find($scheduleId)
    {
        return Schedule::find($scheduleId);
    }

    /**
     * Update a schedule.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return bool
     */
    public function update($request, $id)
    {
        $schedule = Schedule::find($id);
        $schedule->name = $request->get('name');
        $schedule->email = $request->get('email');
        if (!empty($request->get('password'))) {
            $schedule->password = bcrypt($request->get('password'));
        }
        if (!is_null($request->get('active'))) {
            $schedule->active = schedule::ACTIVE;
        } else {
            $schedule->active = schedule::INACTIVE;
        }
        $schedule->save();
        
        return $schedule;
    }

    /**
     * Create a schedule.
     * @param \Illuminate\Http\Request $request
     * @return Schedule
     */
    public function create($request)
    {
        $active = is_null($request->get('active')) ? Schedule::INACTIVE : Schedule::ACTIVE;
        $schedule = Schedule::create([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt($request->get('password')),
                    'role_id' => $request->get('role_id'),
                    'active' => $active
        ]);
        return $schedule;
    }

    /**
     * Delete a schedule.
     * @param int $id
     */
    public function delete($id)
    {
        $schedule = $this->find($id);
        $schedule->delete();
    }
    
    /**
     * Count schedule
     * @return type
     */
    public function count(){
        return $this->model->where('active',Schedule::ACTIVE)->count();
    }

    public function getActiveList() {
        return $this->model->where('status','=',1)->get();
    }

    public function getPairList($schedule_id) {
        $users = \App\Invitation::where('schedule_id', $schedule_id)->select('user_id1')->get();
        foreach ($users as $key => $value) {
            $user_info = \App\User::find($value->user_id1);
            $value->user_info = $user_info;
            $users[$key] = $value;
        }
        return $users;
    }

    public function joinPair($userId1, $scheduleId) {
        \App\Invitation::where('schedule_id',$scheduleId)->where('user_id1', $userId1)
        ->update(['user_id2' => Auth::id(), 'status' => 'JOINED']);
    }

    public function selfAdd($userId1, $scheduleId) {
        $invitation = new \App\Invitation;
        $invitation->user_id1 = $userId1;
        $invitation->user_id2 = -1;
        $invitation->schedule_id = $scheduleId;
        $invitation->status = 'WAIT';
        $invitation->save();
    }
    
    public function getScheduleDetail(Request $request) {
        $theater_id = $request->theater_id;
        $movieTitle = DB::select('SELECT DISTINCT movies.id, title, url '
                        . 'FROM movies INNER JOIN schedules '
                        . 'ON movies.id = schedules.movie_id '
                        . 'WHERE theater_id = ?', [$theater_id]);
        foreach ($movieTitle as $key => $value) {
            $schedule_detail = DB::select('WITH seatnum AS 
                                (SELECT id, row_num * column_num AS totalseat FROM theaters WHERE status = 1)
                        SELECT schedules.id, show_date, show_time, type, totalseat - count(tickets.id) AS totalseat
                        FROM tickets 
                        RIGHT JOIN schedules ON tickets.schedule_id = schedules.id
                        INNER JOIN seatnum ON schedules.theater_id = seatnum.id
                        WHERE schedules.status = 1
                        AND theater_id = ?
                        AND movie_id = ?
                        GROUP BY schedules.id, seatnum.totalseat
                        ORDER BY show_date ASC, show_time ASC', [$theater_id, $value->id]);
            $value->schedule_detail = $schedule_detail;
            $movieTitle[$key] = $value;
        }
        return $movieTitle;
    }

    public function getScheduleForOnlyOneMovie(Request $request) {
        $theater_id = $request->theater_id;
        $movie_id = $request->movie_id;
        $movieTitle = DB::select('SELECT DISTINCT movies.id, title, url '
                        . 'FROM movies INNER JOIN schedules '
                        . 'ON movies.id = schedules.movie_id '
                        . 'WHERE theater_id = ? '
                        . 'AND movie_id = ?', [$theater_id, $movie_id]);
        foreach ($movieTitle as $key => $value) {
            $scheduleDetail = DB::select('WITH seatnum AS 
                                (SELECT id, row_num * column_num AS totalseat FROM theaters WHERE status = 1)
                        SELECT schedules.id, show_date, show_time, type, totalseat - count(tickets.id) AS totalseat
                        FROM tickets 
                        RIGHT JOIN schedules ON tickets.schedule_id = schedules.id
                        INNER JOIN seatnum ON schedules.theater_id = seatnum.id
                        WHERE schedules.status = 1
                        AND theater_id = ?
                        AND movie_id = ?
                        GROUP BY schedules.id, seatnum.totalseat
                        ORDER BY show_date ASC, show_time ASC', [$theater_id, $value->id]);
            $value->schedule_detail = $scheduleDetail;
            $movieTitle[$key] = $value;
        }
        return $movieTitle;
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