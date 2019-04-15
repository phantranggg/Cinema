<?php

namespace App\Repositories;

use App\Movie;
use App\Repositories\Support\SAbstractRepository;

class MovieRepository extends SAbstractRepository
{

    const SORT_BY_ARR = ['DESC', 'ASC'];
    const ORDER_BY = 'id';

    /**
     * Define primary model in this repository.
     * @return string
     */
    public function model()
    {
        return 'App\Movie';
    }

    /**
     * Rules create.
     * @return array
     */
    public function rulesCreate()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:Movies,email,NULL,id,deleted_at,NULL',
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
        $rules['email'] = "required|email|unique:Movies,email,$id,id,deleted_at,NULL";
        $rules['password'] = 'min:4';
        return $rules;
    }

    /**
     * Find a movie
     * @param int $movieId
     * @return Movie
     */
    public function find($movieId)
    {
        return Movie::find($movieId);
    }

    /**
     * Update a movie
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return bool
     */
    public function update_array($id,$data){
        $movie = Movie::find($id);
        foreach($data as $key=>$value){
            if($key=='title'){
                $movie->title=$value;
            }
            elseif($key=='status'){
                $movie->status=$value;
            }
        }
//        $movie->title=$request->title;
//        $movie->release_date=$request->release_date;
//        $movie->genres=$request->genres;
//        $movie->score=$request->score;
//        $movie->director=$request->director;
//        $movie->country=$request->country;
//        $movie->length=$request->length;
//        $movie->subtitle=$request->subtitle;
//        $movie->rating=$request->rating;
        $movie->save();

        return $movie;
    }
    public function update($request, $id)
    {
        $movie = Movie::find($id);
        $movie->title=$request->title;
        $movie->release_date=$request->release_date;
        $movie->genres=$request->genres;
        $movie->score=$request->score;
        $movie->director=$request->director;
        $movie->country=$request->country;
        $movie->length=$request->length;
        $movie->subtitle=$request->subtitle;
        $movie->rating=$request->rating;
        $movie->save();
        
        return $movie;
    }

    /**
     * Create a movie.
     * @param \Illuminate\Http\Request $request
     * @return Movie
     */
    public function create($request)
    {
//        $active = is_null($request-['active']) ? Movie::INACTIVE : Movie::ACTIVE;
        $movie = Movie::create([
            'title'=>$request->get('title'),
            'release_date'=>$request->get('release_date'),
            'genres'=>$request->get('genres'),
            'score'=>$request->get('score'),
            'director'=>$request->get('director'),
            'country'=>$request->get('country'),
            'length'=>$request->get('length'),
            'subtitle'=>$request->get('subtitle'),
            'rating'=>$request->get('rating'),
            'status'=> Movie::ACTIVE,
            'url'=>'some url in here, change it in movie repository'
        ]);
//        $avatar = $request->file('file');
//        if (isset($avatar)) {
//            $upload = $avatar->getClientOriginalName();
//            $filename = str_slug(pathinfo($upload, PATHINFO_FILENAME));
//            $fileExtension = str_slug(pathinfo($upload, PATHINFO_EXTENSION));
//            $changeName = time() . '_' . $filename . '.' . $fileExtension;
//            $avatar->move(Movie::PATH_AVATAR, $changeName);
//            $avatarPath = Movie::PATH_AVATAR . $changeName;
//            $movie->avatar = $avatarPath;
//            $movie->save();
//        }
        return $movie;
    }

    /**
     * Delete a movie
     * @param int $id
     */
    public function delete($id)
    {
        $movie = $this->find($id);
        $movie->delete();
    }
    
    /**
     * Count movie
     * @return type
     */
    public function count(){
        return $this->model->where('status',Movie::ACTIVE)->count();
    }

    public function checkLike($movieId) 
    {
        $logged = \Auth::user();
        if (is_null($logged)) {
            return FALSE;
        }
        $check = \DB::table('likes')->where('user_id', '=', $logged->id)
                ->where('movie_id', '=', $movieId)
                ->first();

        if (is_null($check)) {
            return FALSE;
        }
        return TRUE;
    }

    public function getNowPlayingList($limit) {
    //    $nowPlayingMovies = \DB::select("SELECT m.* FROM movies m
    //                    WHERE status = 1
    //                    AND 1 <= (select count(*) from schedules, movies where schedules.movie_id = movies.id and movies.id = m.id)
    //                    ORDER BY ticket_num DESC, like_num DESC
    //                    LIMIT ?", [$limit]);
        $nowPlayingMovies=Movie::where('release_date','>=',config('constant.today'))->orderBy('like_num', 'desc')->paginate($limit);
        // $nowPlayingMovies=$nowPlayingMovies->get();
        // paginate($limit);
        // dd($nowPlayingMovies);
        return $nowPlayingMovies;
    }
    
    public function getCommingSoonList($limit) {
    //    $commingSoonMovies = \DB::select("SELECT m.* FROM movies m
    //                    WHERE status = 1
    //                    AND 1 > (select count(*) from schedules, movies where schedules.movie_id = movies.id and movies.id = m.id)
    //                    ORDER BY ticket_num DESC, like_num DESC
    //                    LIMIT ?", [$limit]);
        $commingSoonMovies = Movie::where('release_date','>=',config('constant.today'))->where('release_date','<=',date('Y-m-d',strtotime(config('constant.today').' + 14 days')))->paginate($limit);
        return $commingSoonMovies;
    }
    
    public function getAllMoviesInOrder($limit) {
        $allmovies = $this->model->where('status', 1)->orderBy('ticket_num', 'desc')->orderBy('like_num', 'desc')->paginate($limit);
        return $allmovies;
        //$allmovies = \App\Movie::where('status', '=', 1)->orderBy('ticket_num', 'desc')->orderBy('like_num', 'desc')->get();
    }
    
    public function getNowPlayingFilter($theaterId) {
        $movies = \DB::select('select m.*, count(tickets.id) as count_ticket
                                from movies m
                                left join schedules on m.id = schedules.movie_id
                                left join tickets on schedules.id = tickets.schedule_id
                                where theater_id = ?
                                and ?::date >= release_date::date 
                                and 14 >= (select ?::date - release_date::date from movies where movies.id = m.id)
                                and m.status = 1
                                group by m.id
                                order by count_ticket desc, like_num desc', [$theaterId, config('constant.today'), config('constant.today')]);
        return $movies;
    }
    
    public function getCommingSoonFilter($thearterId) {
        $movies = \DB::select('select m.*, count(tickets.id) as count_ticket
                                from movies m
                                left join schedules on m.id = schedules.movie_id
                                left join tickets on schedules.id = tickets.schedule_id
                                where theater_id = ?
                                and release_date::date > ?::date
                                and 14 >= (select release_date::date - ?::date from movies where movies.id = m.id)
                                and m.status = 1
                                group by m.id
                                order by like_num desc, count_ticket desc', [$theaterId, config('constant.today'), config('constant.today')]);
        return $movies;
    }

    public function findByKeyword($keyword) {
        $result = $this->model->where('title', 'LIKE', '%' . $keyword . '%')->get();
        return $result;
    }

}
