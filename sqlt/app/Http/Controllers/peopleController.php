<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;

class peopleController extends Controller
{
    public function index(){
        $datapersons = People::all();
        return view('persons')->with('datapersons', $datapersons);
    }
}
