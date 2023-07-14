<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistrationFormRequest;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';
    const JOB_POSTER = 'employer';

    public function createSeeker()
    {
        return view('user.seeker');
    }

    public function storeSeeker(RegistrationFormRequest $request)
    {

        $user = User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => self::JOB_SEEKER
        ]);
        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json('success');
        #return redirect()->route('verification.notice')->with('successMessage','Your account was successfully created.');

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
                if(auth()->user()->user_type==self::JOB_SEEKER) {
                    return redirect()->to('/dashboard');
                }else{
                    return redirect()->to('/');
                }


        }

        return 'Wrong email or password';
    }

    public function createEmployer()
    {
        return view('user.employer');
    }

    public function storeEmployer(RegistrationFormRequest $request)
    {

        $user = User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => self::JOB_POSTER,
            'user_trial' => now()->addWeek()
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json('success');
        #return redirect()->route('verification.notice')->with('successMessage','Your account was successfully created.');

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');

    }

    public function profile()
    {
        return view('profile.index');
    }

    public function seekerProfile()
    {
        return view('seeker.profile');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();
        if(Hash::check($request->current_password, $user->password)) {
            return back()->with("error","Your current password is incorrect!");
        }
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with("success","Your password has been updated successfully!");

    }

    public function update(Request $request)
    {
        if($request->hasFile('profile_pic')) {
            $imagePath = $request->file('profile_pic')->store('profile','public');

            User::find(auth()->user()->id)->update(['profile_pic' => $imagePath ]);
        }

        User::find(auth()->user()->id)->update($request->except('profile_pic'));

        return back()->with("success","Company name updated");
    }
}
