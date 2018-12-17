<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Repositories\Support\SAbstractRepository;
use App\Theater;

class TheaterRepository extends SAbstractRepository
{

    const SORT_BY_ARR = ['DESC', 'ASC'];
    const ORDER_BY = 'id';

    /**
     * Define primary model in this repository.
     * @return string
     */
    public function model()
    {
        return 'App\Theater';
    }

    /**
     * Rules create.
     * @return array
     */
    public function rulesCreate()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:theaters,email,NULL,id,deleted_at,NULL',
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
        $rules['email'] = "required|email|unique:theaters,email,$id,id,deleted_at,NULL";
        $rules['password'] = 'min:4';
        return $rules;
    }

    public function index(){
        return Theater::paginate(15);
    }
    /**
     * Find a theater
     * @param int $theaterId
     * @return Theater
     */
    public function find($theaterId)
    {
        return Theater::find($theaterId);
    }

    /**
     * Update a theater.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return bool
     */
    public function update($request)
    {
        DB::update('UPDATE theaters '
            . 'SET name = ?, hotline = ?, row_num = ?, column_num = ?, fax = ?, '
            . 'address = ?'
            . 'WHERE id = ?', [$request->name, $request->hotline, $request->row_num, $request->column_num,
            $request->fax, $request->address, $request->id]);
        $theater = Theater::find($request->id);
        return $theater;
    }

    /**
     * Create a theater.
     * @param \Illuminate\Http\Request $request
     * @return Theater
     */
    public function create($data)
    {
        $theater = Theater::create($data);
        $theater->save();
        return $theater;
    }

    /**
     * Delete a theater.
     * @param int $id
     */
    public function delete($id)
    {
        $theater = $this->find($id);
//        $theater->status=0;
        $theater->delete();
    }


    /**
     * Count theater
     * @return type
     */
    public function count(){
        return $this->model->count();
    }
    public function getAllName(){
        return DB::select('SELECT id,name FROM theaters');
    }
    public function getActiveList() {
        return $this->model->where('status','=',1)->get();
    }

    public function getIndexForOnlyOneMovie($movieId) {
        $theaters = DB::select('SELECT DISTINCT theaters.id, name FROM theaters '
                        . 'INNER JOIN schedules ON theaters.id = schedules.theater_id '
                        . 'WHERE movie_id = ? '
                        . 'AND theaters.status = 1 '
                        . 'AND schedules.status = 1', [$movieId]);
        return $theaters;
    }
    public function countNumberTicket(){
        return DB::select('SELECT name,count(*)
        FROM theaters LEFT JOIN schedules ON (theaters.id = schedules.theater_id) 
                      JOIN tickets ON (schedules.id = tickets.schedule_id)
        GROUP BY theaters.id');
    }
}
