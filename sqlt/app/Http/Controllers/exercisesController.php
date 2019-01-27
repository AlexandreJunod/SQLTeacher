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
        return view('exercises')->with('exercises', $exercises)->with('peoples', $peoples)->with('scores', $scores);
    }

    public function correct(Request $request)
    {
        $acronyms = People::where('acronym', '=' , $request->acronym)->get();
        foreach ($acronyms as $acronym)
        {

            
            $scores = score::where('people_id', '=', $acronym->id)->where('querie_id', '=', $request->question)->get(); //Select the score of the user being updated
            if($scores == '[]') //Create a new entry 
            {
                $prev_question = $request->question -1;
                $prev_question = score::where('people_id', '=', $acronym->id)->where('querie_id', '=', $prev_question)->get(); //Select the previos question
                
                if($prev_question == '[]' && $request->question > 1) //Disallow the user to answer to a question if he didn't tried the previous question 
                {
                    $error = "Essayez de répondre aux questions précédents avant celle-ci";
                }
                else // Allow the user to send his answer
                {
                    $newscore = new score;
                    $newscore->success = '0';
                    $newscore->attempts = '0';
                    $newscore->people_id = $acronym->id;
                    $newscore->querie_id = $request->question;
                    $newscore->save();

                    $error = "La participation à la question a été crée, veuillez valider une deuxième fois la question";
                }
            }
            else //Update an existant entry
            {
                foreach($scores as $score)
                {
                    if($score->success == false)
                    {
                        $queries = querie::where('order', '=', $request->question)->get();
                        
                        foreach($queries as $querie) //Watch the query corresponding to the question answered by the user
                        {

                            try //try to execute a query, if it's not working, the db is probably not created
                            {
                                DB::select($querie->statement);                                
                            }
                            catch(\Exception $e) //create DB with query given by the teacher
                            {
                                $exercises = exercise::where('id', '=', $querie->exercise_id)->get();
                                foreach($exercises as $exercise)
                                {
                                    DB::select($exercise->statement);
                                }
                            }

                            try //Syntax corect ?
                            {
                                $teacherquery = DB::select($querie->statement); //Syntax of the teacher 
                                $studentquery = DB::select($request->answer); //Syntax of the student 

                                if($teacherquery == $studentquery) //Compare the result of the 2 queries, if this is the same, the student has the right answer
                                {
                                    $newattemp = $score->attempts +1;
                                        score::where('people_id', '=', $acronym->id)
                                        ->where('querie_id', '=', $request->question)
                                        ->update([
                                            'attempts'  =>  $newattemp,
                                            'success'   =>  1]);
                                }
                                else 
                                {
                                    $newattemp = $score->attempts +1;
                                        score::where('people_id', '=', $acronym->id)
                                        ->where('querie_id', '=', $request->question)
                                        ->update(['attempts' => $newattemp]);
                                }
                            }
                            catch(\Exception $e)
                            {
                                $newattemp = $score->attempts +1;
                                    score::where('people_id', '=', $acronym->id)
                                    ->where('querie_id', '=', $request->question)
                                    ->update(['attempts' => $newattemp]);
                                $error = "Syntaxe incorrecte";
                            }
                        }                        
                    }
                    else //Permission denied to update the number of attemps. The user has find the right answer
                    {
                        $error = "La réponse est déjà correcte";
                    }
                } 
            }
        }
            return redirect('exercises')->with('error', $error);
    }
}
