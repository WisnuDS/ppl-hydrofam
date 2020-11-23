<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        if (auth()->user()->isA('super')){
            return redirect('/super/home');
        }elseif (auth()->user()->isA('admin')){
            return redirect('/');
        }elseif (auth()->user()->isA('user')){
            return redirect('/');
        }else{
            return abort(403);
        }
    }
}
