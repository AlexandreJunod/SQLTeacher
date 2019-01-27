<?php

namespace App\Http\Controllers;

use App\exercise;
use App\querie;
use App\People;
use App\score;
use DB;
use Illuminate\Http\Request;

class exercisesController extends Controller
{
    public function index(){
        $exercises = exercise::all();
        $peoples = People::all();
        $scores = score::with(['People', 'querie'])->orderBy('querie_id')->get();


        DB::beginTransaction();
        $test = DB::select("INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Xavier6', 'CARREL6', 'Xavier6.CARREL6@cpnv.ch', 'XC6', '1', '2')");
        $test2 = DB::select("SELECT * FROM people");
        DB::rollback();
        //dd($test2);
        //dd($scores);
        return view('exercises')->with('exercises', $exercises)->with('peoples', $peoples)->with('scores', $scores);
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
