<?php

namespace App\Http\Controllers;

use App\exercise;
use App\querie;
use App\People;
use App\score;
use Illuminate\Http\Request;

class exercisesController extends Controller
{
    public function index(){
        $exercises = exercise::all();
        return view('exercises')->with('exercises', $exercises);
    }

    public function correct(Request $request)
    {
        $acronyms = People::where('acronym', '=' , $request->acronym)->get();
        foreach ($acronyms as $acronym)
        {
            $score = new score;
            $score->nbattempts = '77';
            $score->success = '0';
            $score->student_id = $acronym->id;
            $score->querie_id = $request->question;
            $score->save();
            //new score('1','0',$acronym->id,$request->question);

        }
    }
}
