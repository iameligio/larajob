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
        return 'create job post';
     }
}
