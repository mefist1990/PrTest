<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{


    public function landing()
        {
            return view('landing.index');
        }

    public function auth()
        {
            return view('landing.auth');
        }
}
