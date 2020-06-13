<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     //buffers viewing of homepage so comment out 
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //display all the 10 faker posts from databaseeder and postfactory
        $post = Post::all();
        return view('home', ['posts'=>$post]);
    }
}
