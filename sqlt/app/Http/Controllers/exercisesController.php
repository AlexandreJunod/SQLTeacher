<?php

namespace App\Http\Controllers;

use App\exercise;
use App\querie;
use Illuminate\Http\Request;

class exercisesController extends Controller
{
    public function index(){
        $exercises = exercise::all();
        return view('exercises')->with('exercises', $exercises);
    }
}
