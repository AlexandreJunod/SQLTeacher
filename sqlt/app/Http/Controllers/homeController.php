<?php

namespace App\Http\Controllers;

use App\exercise;
use Session;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        $exercises = exercise::all();
        return view('welcome')->with('exercises', $exercises);
    }
}
