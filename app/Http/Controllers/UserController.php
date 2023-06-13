<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SeekerRegistrationRequest;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';

    public function createSeeker()
    {
        return view('user.seeker');
    }

    public function storeSeeker(SeekerRegistrationRequest $request)
    {

        User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => self::JOB_SEEKER
        ]);

        return back();

    }

    public function login()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentails = $request->only('email', 'password');

        if(Auth::attempt($credentails)) {

                return redirect()->to('/dashboard');

        }

        return 'Wrong email or password';
    }
}
