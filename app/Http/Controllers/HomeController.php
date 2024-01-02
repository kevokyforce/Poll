<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $polls = DB::table('polls')->get();
             foreach ($polls as $value) {
                    $votes = DB::table('options')->where('poll_id','=', $value->id)->sum('votes_count');
             }
         
        return view('layouts.dashboard', compact('polls','votes'));
    }
    
    public function users()
    {
        $users = DB::table('users')->get();
        
        return view('polls.users', compact('users'));
    }
}
