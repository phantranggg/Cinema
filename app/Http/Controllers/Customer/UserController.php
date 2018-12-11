<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $userService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }
    
    public function profile() {
        return view('customer.user.profile')->with(['user' => Auth::user()]);
    }

    public function update(Request $request) {
        $this->userService->update($request, Auth::user()->id);
        return back()->with('success','You have successfully update profile');
    }
}
