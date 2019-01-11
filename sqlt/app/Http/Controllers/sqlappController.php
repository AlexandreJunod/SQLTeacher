<?php

namespace App\Http\Controllers;

use App\student;
use Illuminate\Http\Request;

class sqlappController extends Controller
{
    public function index(){
        $students = student::all();
        return view('sqlapp')->with('students', $students);
    }
}
