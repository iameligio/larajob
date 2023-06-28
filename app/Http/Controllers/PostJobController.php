<?php

namespace App\Http\Controllers;


use App\Post\JobPost;
use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Middleware\isPremiumUser;
use App\Http\Requests\JobPostFormRequest;

class PostJobController extends Controller
{
    protected $job;

    public function __construct(JobPost $job)
    {
        $this->middleware(['auth',isPremiumUser::class]);
        $this->job = $job;
    }

     public function create()
     {
        return view('job.create');
     }

     public function store(JobPostFormRequest $request)
     {


        $this->job->store($request);

        return back();
     }
}
