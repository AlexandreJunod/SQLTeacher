<?php

namespace App\Http\Controllers;

use App\exercise;
use Session;
use Illuminate\Http\Request;

class managementController extends Controller
{
    public function index(){
            $dataexercises = exercise::all();
            return view('management')->with('dataexercises', $dataexercises);
        }

        public function crud(Request $request){
            $dataexercises = exercise::all();

            if(isset($request->update))
            {
                $toUpdate = $request->update;
                return view('management')->with('dataexercises', $dataexercises)->with('toUpdate', $toUpdate);
            }

            if(isset($request->delete))
            {
                exercise::where('id', '=', $request->delete)
                ->delete();
                return redirect('management');
            }

            if(isset($request->confirm))
            {
                try {
                    if(isset($request->title))
                    {
                        exercise::where('id', '=', $request->confirm)
                        ->update([
                          'title'   =>    $request->title]);
                    }

                    if(isset($request->db_script))
                    {
                        exercise::where('id', '=', $request->confirm)
                        ->update([
                          'db_script'    =>    $request->db_script]);
                    }
                } catch (\Exception $e) {
                    Session::flash("Error", "Données non compatibles");
                    return redirect('management');
                }
            }

            if(isset($request->title) && isset($request->db_script))
            {
                try {
                    $newexercise = new exercise;
                    $newexercise->title = $request->title;
                    $newexercise->db_script = $request->db_script;
                    $newexercise->save();
                    return redirect('management');
                } catch (\Exception $e) {
                    Session::flash("Error", "Données non compatibles");
                }
            }
            else
            {
                Session::flash("Error", "Tous les champs n'ont pas étés remplis");
                return redirect('management');
            }
            return view('management')->with('dataexercises', $dataexercises);
        }
}
