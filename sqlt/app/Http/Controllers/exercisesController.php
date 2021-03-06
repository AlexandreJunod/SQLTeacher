<?php

namespace App\Http\Controllers;

use App\exercise;
use App\querie;
use App\People;
use App\score;
use DB;
use Session;
use Illuminate\Http\Request;

// TODO: Mettre à jour le CSS
// TODO: Permettre de faire du CRUD dans la base de donnée à l'aide des "transactions". Cette option était disponible masi je ne savais pas comment comparé deux requêtes qui permettent de "créer/supprimer/modifier" une entrée
// TODO: Gérer plusieurs questionnaires
// TODO: Permetre de gérer les classes et les élèves
// TODO: Permetre d'ajouter manuellement les exercices

class exercisesController extends Controller
{
    public function index($id){
        $exercises = exercise::where('id', '=', $id)->get();
        $peoples = People::all();
        $scores = score::with(['People', 'querie'])->orderBy('querie_id')->get();
        return view('exercises')->with('exercises', $exercises)->with('peoples', $peoples)->with('scores', $scores)->with('id', $id);
    }

    public function download($id){
        $myscripts = exercise::where('id', '=', $id)->get();
        foreach ($myscripts as $myscript) {
            try{
                $my_file = 'script.txt';
                $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
                $data = $myscript->db_script;
                fwrite($handle, $data);
                unlink($my_file);
                //header("..\..\..\public\script.txt");
            }
            catch(\Exception $e)
            {
                Session::flash('Error', 'Problème lors de la création du fichier');
            }
        }
        return redirect('exercises/'.$id);
    }

    public function correct(Request $request, $id)
    {
        $acronyms = People::where('acronym', '=' , $request->acronym)->get();
        if($acronyms == '[]') //This acronym doesn't exists
        {
            Session::flash('Error', 'Acronyme inexistant');
            return redirect('exercises/'.$id);
        }

        $nbquestions = Querie::where('exercise_id', '=', $id)->count('id');
        if($nbquestions < $request->question)
        {
            Session::flash('Error', "Cette question n'existe pas");
            return redirect('exercises/'.$id);
        }

        foreach ($acronyms as $acronym)
        {
            $questions = querie::where('exercise_id', '=', $id)->where('order', '=', $request->question)->get();
            foreach ($questions as $question)
            {
                $scores = score::where('people_id', '=', $acronym->id)->where('querie_id', '=', $question->id)->get(); //Select the score of the user being updated

                if($scores == '[]') //Create a new entry
                {
                    $prev_question = $request->question -1;
                    $prev_question = score::where('people_id', '=', $acronym->id)->where('querie_id', '=', $prev_question)->get(); //Select the previos question
                    if($prev_question == '[]' && $request->question > 1) //Disallow the user to answer to a question if he didn't tried the previous question
                    {
                        Session::flash('Error', 'Essayez de répondre aux questions précédents avant celle-ci');
                    }
                    else // Allow the user to send his answer
                    {
                        $newscore = new score;
                        $newscore->success = '0';
                        $newscore->attempts = '0';
                        $newscore->people_id = $acronym->id;
                        $newscore->querie_id = $question->id;
                        $newscore->save();
                        Session::flash('Error', 'La participation à la question a été crée, veuillez valider une deuxième fois la question');
                    }
                }
                else //Update an existant entry
                {
                    foreach($scores as $score)
                    {
                        if($score->success == false)
                        {
                            $queries = querie::where('exercise_id', '=', $id)->where('order', '=', $request->question)->get();
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
                                        $str_arr = explode(";", $exercise->db_script); //Split beetwen each ";"
                                        foreach ($str_arr as $key=>$value) { //If there is data, it will be created
                                            if($value != '') //Sometimes it sends spaces, it prevents to return an error
                                            DB::select($value);
                                        }
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
                                            ->where('querie_id', '=', $question->id)
                                            ->update([
                                                'attempts'  =>  $newattemp,
                                                'success'   =>  1]);
                                    }
                                    else
                                    {
                                        $newattemp = $score->attempts +1;
                                            score::where('people_id', '=', $acronym->id)
                                            ->where('querie_id', '=', $question->id)
                                            ->update(['attempts' => $newattemp]);
                                    }
                                }
                                catch(\Exception $e)
                                {
                                    $newattemp = $score->attempts +1;
                                        score::where('people_id', '=', $acronym->id)
                                        ->where('querie_id', '=', $question->id)
                                        ->update(['attempts' => $newattemp]);
                                    Session::flash('Error', 'Requête ou syntaxe incorrecte');
                                }
                            }
                        }
                        else //Permission denied to update the number of attemps. The user has find the right answer
                        {
                            Session::flash('Error', 'La réponse est déjà correcte');
                        }
                    }
                }
            }
            return redirect('exercises/'.$id);
        }
    }
}
