<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\isPremiumUser;

class PostJobController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth',isPremiumUser::class]);
    }

     public function create()
     {
        return view('job.create');
     }

     public function store(Request $request)
     {
        $this->validate($request, [
            'title' => 'required|min:5',
            'featured_image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'description' => 'required|min:10',
            'roles' => 'required|min:10',
            'job_type' => 'required',
            'address' => 'required',
            'date' => 'required'
        ]);
     }
}
