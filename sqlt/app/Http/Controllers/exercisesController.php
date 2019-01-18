<?php

namespace App\Http\Controllers;

use App\exercise;
use App\queries;
use Illuminate\Http\Request;

class exercisesController extends Controller
{
    public function index(){
        $dataexercises = exercise::all();
        return view('exercises')->with('dataexercises', $dataexercises);
    }
}
