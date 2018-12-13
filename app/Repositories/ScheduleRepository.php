<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
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
}