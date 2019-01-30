<?php

namespace App\Http\Controllers;

use App\People;
use App\score;
use Session;
use Illuminate\Http\Request;

// TODO: Afficher une dropdown pour choisir la classe de l'éléve
// TODO: Ajouter un bouton "est prof" afin de passé le role à "2" qui veut dire "Enseignant"
// TODO: Ajouter un bouton pour supprimer les données de la table Scores
// TODO: Faire une page similiaire pour les questions/exercices. Ajouter une attribution d'exercice à une certaine classe

class peopleController extends Controller
{
    public function index(){
        $datapersons = People::all();
        return view('persons')->with('datapersons', $datapersons);
    }

    public function crud(Request $request){
        $datapersons = People::all();

        if(isset($request->update))
        {
            $toUpdate = $request->update;
            return view('persons')->with('datapersons', $datapersons)->with('toUpdate', $toUpdate);
        }

        if(isset($request->delete))
        {
            score::where('people_id', '=', $request->delete)
            ->delete();
            People::where('id', '=', $request->delete)
            ->delete();
            Session::flash("Error", "Suppression des scores et de l'utilisateur réussi");
            return redirect('persons');
        }

        if(isset($request->confirm))
        {
            try {
                if(isset($request->firstname))
                {
                    People::where('id', '=', $request->id)
                    ->update([
                      'firstname'   =>    $request->firstname]);
                }

                if(isset($request->lastname))
                {
                    People::where('id', '=', $request->id)
                    ->update([
                      'lastname'    =>    $request->lastname]);
                }

                if(isset($request->email))
                {
                    People::where('id', '=', $request->id)
                    ->update([
                      'email'       =>    $request->email]);
                }

                if(isset($request->acronym))
                {
                    People::where('id', '=', $request->confirm)
                    ->update([
                      'acronym'     =>    $request->acronym]);
                }

            } catch (\Exception $e) {
                Session::flash("Error", "Données non compatibles");
                return redirect('persons');
            }
        }

        if(isset($request->firstname) && isset($request->lastname) && isset($request->email) && isset($request->acronym))
        {
            try {
                $newperson = new People;
                $newperson->firstname = $request->firstname;
                $newperson->lastname = $request->lastname;
                $newperson->email = $request->email;
                $newperson->acronym =$request->acronym;
                $newperson->classe_id = '1';
                $newperson->role_id = '1';
                $newperson->save();
                return redirect('persons');
            } catch (\Exception $e) {
                Session::flash("Error", "Données non compatibles");
            }
        }
        else
        {
            Session::flash("Error", "Tous les champs n'ont pas étés remplis");
            return redirect('persons');
        }
        return view('persons')->with('datapersons', $datapersons);
    }
}
