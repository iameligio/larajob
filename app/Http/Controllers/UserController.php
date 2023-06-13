<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';

    public function createSeeker()
    {
        return view('user.seeker');
    }

    public function storeSeeker(Request $request)
    {
        User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => self::JOB_SEEKER
        ]);

        return back();

    }
}
