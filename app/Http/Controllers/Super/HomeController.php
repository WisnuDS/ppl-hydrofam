<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $role = auth()->user()->roles[0]->title;
        return view('welcome',compact('role'));
    }
}
