<?php

namespace App\Repositories;

use App\User;
use App\Ticket;
use App\Repositories\Support\SAbstractRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class UserRepository extends SAbstractRepository
{

    const SORT_BY_ARR = ['DESC', 'ASC'];
    const ORDER_BY = 'id';

    /**
     * Define primary model in this repository.
     * @return string
     */
    public function model()
    {
        return 'App\User';
    }

    /**
     * Rules create.
     * @return array
     */
    public function rulesCreate()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
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
        $rules['email'] = "required|email|unique:users,email,$id,id,deleted_at,NULL";
        $rules['password'] = 'min:4';
        return $rules;
    }

    /**
     * Get all roles array.
     * @return type
     */
    public function roleArr()
    {
        return [
            User::ROLE_ADMIN => 'ADMIN',
            User::ROLE_USER => 'USER'
        ];
    }

    /**
     * Find a user
     * @param int $userId
     * @return User
     */
    public function find($userId)
    {
        return User::find($userId);
    }

    /**
     * Get all user with role = ADMIN
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Pagination\Paginator
     */
    public function roleAdmin($request)
    {
        $query = $this->all($request, null);
        return $query->where('role_id', '=', User::ROLE_ADMIN)->paginate(self::PAGE_SIZE);
    }

    /**
     * Get all user with role = USER
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Pagination\Paginator
     */
    public function roleUser($request)
    {
        $query = $this->all($request, null);
        return $query->where('role_id', '=', User::ROLE_USER)->paginate(self::PAGE_SIZE);
    }
    public function updateAdmin($user_id,$request){
//        $user=User::find($user_id);
//        foreach ($data as $key=>$value){
//            if($key=='date_of_birth'){
//                $user->date_of_birth=$value;
//            }
//        }
                DB::update('UPDATE users '
                . 'SET date_of_birth = ?, phone = ?, address = ?, account_type = ?, role = ? '
                . 'WHERE id = ?', [$request->date_of_birth, $request->phone, $request->address, $request->account_type, $request->role, $user_id]);
    }
    /**
     * Update a user.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return bool
     */
    public function update($request) {
        if ($request->password === $request->password_confirmation) {
            DB::update('UPDATE users '
                    . 'SET password = ?, date_of_birth = ?, phone = ?, address = ? '
                    . 'WHERE id = ?', [bcrypt($request->password), $request->date_of_birth, $request->phone, $request->address, Auth::id()]);
        }
    }
    // public function update($request, $id)
    // {
    //     $user = User::find($id);
    //     $user->name = $request->get('name');
    //     $user->email = $request->get('email');
    //     if (!empty($request->get('password'))) {
    //         $user->password = bcrypt($request->get('password'));
    //     }
    //     if (!is_null($request->get('active'))) {
    //         $user->active = User::ACTIVE;
    //     } else {
    //         $user->active = User::INACTIVE;
    //     }
    //     $user->role_id = $request->get('role_id');
    //     if ($user->id == User::CAN_NOT_DELETE) {
    //         $user->active = User::ACTIVE;
    //         $user->role_id = User::ROLE_ADMIN;
    //     }
    //     $avatar = $request->file('avatar');
    //     if (isset($avatar)) {
    //         $upload = $avatar->getClientOriginalName();
    //         $filename = str_slug(pathinfo($upload, PATHINFO_FILENAME));
    //         $fileExtension = str_slug(pathinfo($upload, PATHINFO_EXTENSION));
    //         $changeName = time() . '_' . $filename . '.' . $fileExtension;
    //         $avatar->move(User::PATH_AVATAR, $changeName);
    //         $avatarPath = User::PATH_AVATAR . $changeName;
    //         $user->avatar = $avatarPath;
    //     }
    //     $user->save();
        
    //     return $user;
    // }

    /**
     * Create a user.
     * @param \Illuminate\Http\Request $request
     * @return User
     */
    public function create($request)
    {
        $active = User::ACTIVE;
        $user = User::create([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt($request->get('password')),
                    'role_id' => $request->get('role_id'),
                    'status' => $active
        ]);
//        $avatar = $request->file('avatar');
//        if (isset($avatar)) {
//            $upload = $avatar->getClientOriginalName();
//            $filename = str_slug(pathinfo($upload, PATHINFO_FILENAME));
//            $fileExtension = str_slug(pathinfo($upload, PATHINFO_EXTENSION));
//            $changeName = time() . '_' . $filename . '.' . $fileExtension;
//            $avatar->move(User::PATH_AVATAR, $changeName);
//            $avatarPath = User::PATH_AVATAR . $changeName;
//            $user->avatar = $avatarPath;
//            $user->save();
//        }
//        if ($request->password === $request->password_confirmation) {
//            DB::insert('INSERT INTO users(name, date_of_birth, email, password, phone, address, account_type, role, status) '
//                . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->name, $request->date_of_birth, $request->email,
//                bcrypt($request->password), $request->phone, $request->address, $request->account_type, $request->role, 1]);
//        }
        return $user;
    }

    /**
     * Delete a user.
     * @param int $id
     */
    public function delete($id)
    {
        $user =$this->model->find($id);
        $user->status=User::INACTIVE;
        $user->save();
//        foreach()
//        $user->delete();
    }
    
    /**
     * Count user
     * @return type
     */
    public function count(){
        return $this->model->where('status',User::ACTIVE)->count();
    }
    public function statitic(){
        return DB::select("SELECT count(id),  
                case    when (2017 - date_part('year', date_of_birth)) < 13 then 1	
                    when (2017 - date_part('year', date_of_birth)) between 13 and 18 then 2
                    when (2017 - date_part('year', date_of_birth)) between 19 and 30 then 3
                    when (2017 - date_part('year', date_of_birth)) between 31 and 50 then 4
                    when (2017 - date_part('year', date_of_birth)) > 50 then 5
                end
            from users
            group by case    when (2017 - date_part('year', date_of_birth)) < 13 then 1	
                when (2017 - date_part('year', date_of_birth)) between 13 and 18 then 2
                when (2017 - date_part('year', date_of_birth)) between 19 and 30 then 3
                when (2017 - date_part('year', date_of_birth)) between 31 and 50 then 4
                when (2017 - date_part('year', date_of_birth)) > 50 then 5
            end

            order by (count(id)) DESC");
    }
    public function getShow(){
        $users = DB::select('WITH ticketnum AS
                            (SELECT tickets.user_id, schedule_id, count(tickets.id) AS num
                            FROM tickets
                            GROUP BY tickets.user_id, schedule_id)
                    SELECT users.*, sum(ticketnum.num * price) AS totalamount
                    FROM users 
                    LEFT JOIN ticketnum ON users.id = ticketnum.user_id
                    LEFT JOIN schedules ON schedules.id = ticketnum.schedule_id
                    WHERE users.status = 1
                    GROUP BY users.id
                    ORDER BY totalamount DESC NULLS LAST');
        return $users;
    }
    public function getOrderedTicketList() {
        $movies = DB::select('SELECT schedules.id, movies.title, theaters.name, schedules.type, schedules.show_date, schedules.show_time, tickets.updated_at '
                        . 'FROM schedules '
                        . 'INNER JOIN movies ON schedules.movie_id = movies.id '
                        . 'INNER JOIN theaters ON schedules.theater_id = theaters.id '
                        . 'INNER JOIN tickets ON schedules.id = tickets.schedule_id '
                        . 'WHERE tickets.user_id = ? '
                        . 'AND show_date >= ? '
                        . 'AND tickets.updated_at IS NOT NULL '
                        . 'GROUP BY tickets.updated_at, schedules.id, movies.title, theaters.name, schedules.show_date, schedules.show_time '
                        . 'ORDER BY tickets.updated_at DESC ', [Auth::id(), config('constant.today')]);
        foreach ($movies as $key => $value) {
            $invitation = \App\Invitation::where('user_id1',Auth::id())->where('schedule_id',$movies[$key]->id)->first();
            if ($invitation) {
                $value->invitation = true;
            } else $value->invitation = false;
            $tickets = DB::select('SELECT chair_num '
                            . 'FROM tickets '
                            . 'WHERE user_id = ? '
                            . 'AND schedule_id = ? ', [Auth::id(), $value->id]);
            $value->tickets = $tickets;
            $movies[$key] = $value;
        }
        return $movies;
    }

    public function like($movieId) {
        \App\Like::insert(['movie_id' => $movieId, 'user_id' => Auth::id()]);
        $movie = \App\Movie::find($movieId);
        $movie->like_num = $movie->like_num + 1;
        $movie->save();
    }
    
    public function unlike($movieId) {
        \App\Like::where('movie_id', '=', $movieId)
                ->where('user_id', '=', Auth::id())->delete();
        $movie = \App\Movie::find($movieId);
        $movie->like_num = $movie->like_num - 1;
        $movie->save();
    }
    
    public function getBill(Request $request) {
        $seatList = $request->seat_list;
        $scheduleId = $request->schedule_id;
        $mySeatList = \App\Ticket::where('schedule_id', $scheduleId)->where('user_id', Auth::id())->get();
        foreach ($seatList as $seat) {
            //$exist = \DB::table('tickets')->where('schedule_id', $scheduleId)->where('chair_num', $seat);
            $exist = DB::select('SELECT id FROM tickets WHERE schedule_id = ? AND chair_num = ?', [$scheduleId, $seat]);
            $exist = Ticket::where('schedule_id', $scheduleId)->where('chair_num', $seat)->first();
            // $exist = \App\Ticket::where('schedule_id', $scheduleId)->where('chair_num', $seat)->get();
            if (!$exist) {
                $ticket = new Ticket;
                $ticket->schedule_id = $scheduleId;
                $ticket->user_id = Auth::id();
                $ticket->chair_num = $seat;
                $ticket->save();
            }
        }
        foreach ($mySeatList as $seat) {
            echo($seat);
            if (!in_array($seat->chair_num, $seatList)) {
                DB::delete('DELETE FROM tickets WHERE schedule_id = ? AND chair_num = ?', [$scheduleId, $seat->chair_num]);
            }
        }
    }

    public function acceptInvitation($invitationId) {
        $joinNotifications = \App\Notification::where('type','App\Notifications\JoinPairNotification')->get();
        foreach ($joinNotifications as $joinNotification) {
            if (json_decode($joinNotification->data)->invitationId == $invitationId) {
                $tmp = str_replace('true', 'false', $joinNotification->data);
                auth()->user()->unreadNotifications->where('notifiable_id', $joinNotification->notifiable_id)->markAsRead();
                $joinNotification->data = $tmp;
                $joinNotification->save();
                break;
            }
        }
        $userId2 = \App\Invitation::find($invitationId)->select('user_id2')->first();
        \App\User::find($userId2->user_id2)->notify(new \App\Notifications\AcceptPairNotification($invitationId));
        \App\Invitation::find($invitationId)->update(['status' => 'ACCEPT']);
    }

    public function declineInvitation($invitationId) {
        $joinNotifications = \App\Notification::where('type','App\Notifications\JoinPairNotification')->get();
        foreach ($joinNotifications as $joinNotification) {
            if (json_decode($joinNotification->data)->invitationId == $invitationId) {
                $tmp = str_replace('true', 'false', $joinNotification->data);
                auth()->user()->unreadNotifications->where('notifiable_id', $joinNotification->notifiable_id)->markAsRead();
                $joinNotification->data = $tmp;
                $joinNotification->save();
                break;
            }
        }
        $userId2 = \App\Invitation::find($invitationId)->select('user_id2')->first();
        \App\User::find($userId2->user_id2)->notify(new \App\Notifications\DeclinePairNotification($invitationId));
        \App\Invitation::find($invitationId)->update(['status' => 'WAIT', 'user_id2' => -1]);
    }
}
