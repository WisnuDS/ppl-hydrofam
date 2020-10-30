<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $role = auth()->user()->roles[0]->title;
        return view('welcome',compact('role'));
    }
}
