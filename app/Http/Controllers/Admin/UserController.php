<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\UserRepository;

class UserController extends Controller
{

    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepo->all($request, false);
        return view('backend/user/index', compact('users'));
    }

    /**
     * Display all user has role ADMIN.
     *
     * @return \Illuminate\Http\Response
     */
    public function roleAdmin(Request $request)
    {
        $users = $this->userRepo->roleAdmin($request);
        return view('backend/user/index', compact('users'));
    }

    /**
     * Display all user has role USER.
     *
     * @return \Illuminate\Http\Response
     */
    public function roleUser(Request $request)
    {
        $users = $this->userRepo->roleUser($request);
        return view('backend/user/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleArr = $this->userRepo->roleArr();
        return view('backend/user/create', compact('roleArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->userRepo->rulesCreate());
        if ($validator->fails()) {
            $this->toastrError($validator->errors()->toArray());
            return redirect()->back()->withInput();
        }
        $this->userRepo->create($request);
        $this->toastrSuccess(trans('backend/base.msg_susscess'));
        return redirect()->route('backend.setting.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepo->find($id);
        if (is_null($user)) {
            abort(404);
        }
        $roleArr = $this->userRepo->roleArr();
        return view('backend/user/show', compact('user', 'roleArr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepo->find($id);
        if (is_null($user)) {
            abort(404);
        } else {
            $roleArr = $this->userRepo->roleArr();
        }
        return view('backend/user/edit', compact('user', 'roleArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->userRepo->rulesUpdate($id));
        if ($validator->fails()) {
            $this->toastrError($validator->errors()->toArray());
            return redirect()->back()->withInput();
        } else {
            $this->userRepo->update($request, $id);
            $this->toastrSuccess(trans('backend/base.msg_susscess'));
            return redirect()->route('backend.setting.user.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepo->find($id);
        $employee = $user->employee;
        if (!is_null($employee)) {
            $this->employeeRepo->delete($employee->id);
        }
        $this->userRepo->delete($id);
        $this->toastrSuccess(trans('backend/base.msg_susscess_delete'));
        return redirect()->back();
    }

}
