<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::paginate(9);
        return view('home', compact('channels'));
    }
}
