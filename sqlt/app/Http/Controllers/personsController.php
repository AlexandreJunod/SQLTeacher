<?php

namespace App\Http\Controllers;

use App\person;
use Illuminate\Http\Request;

class personsController extends Controller
{
    public function index(){
        $datapersons = person::all();
        return view('persons')->with('datapersons', $datapersons);
    }
}
