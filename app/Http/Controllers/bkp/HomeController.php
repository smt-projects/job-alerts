<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }


     /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function myHome()
   {
       return view('myHome');
        // echo "Hello Home";
   }
   /**
    * Show the my users page.
    *
    * @return \Illuminate\Http\Response
    */
   public function myUsers()
   {
       return view('myUsers');
   }

}
