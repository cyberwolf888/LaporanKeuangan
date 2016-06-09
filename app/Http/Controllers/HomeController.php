<?php

namespace App\Http\Controllers;

use Auth;
use PHPZen\LaravelRbac\Model\Role;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Models\Bedebah;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$request = new Request();
        //print_r(Auth::user()->type);
        return view('home');
    }

    public function admin()
    {
        $bedebah = new Bedebah();
        return $bedebah->fuck();
    }

    public function test(){
        $isOperator = Auth::user()->hasRole('operator');
        print_r($isOperator);
        //return $isOperator;
    }
}
