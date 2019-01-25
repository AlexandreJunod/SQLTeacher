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
        // $scores = score::all();
        $queries = querie::all();
        return view('exercises')->with('exercises', $exercises)->with('queries', $queries);
    }

    public function correct(Request $request)
    {
        $acronyms = People::where('acronym', '=' , $request->acronym)->get();
        foreach ($acronyms as $acronym)
        {
            $score = new score;
            $score->success = '1';
            $score->people_id = $acronym->id;
            $score->querie_id = $request->question;
            $score->save();
        }
        return redirect('exercises');
    }
}
