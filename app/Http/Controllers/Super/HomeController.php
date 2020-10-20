<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $role = auth()->user()->roles[0]->title;
        return view('home',compact('role'));
    }
}
