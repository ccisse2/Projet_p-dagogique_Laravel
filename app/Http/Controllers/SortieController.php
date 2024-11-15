<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Sortie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SortieController extends Controller
{
    public function index(Request $request){
        $campusList = Campus::all();
        $user = Auth::user();

        //initialisattion de la requette avec pagination
        $sorties = Sortie::query();

        if($request->filled('campus')){
            $sorties->where('campus_id', $request->input('campus'));
        }

        if($request->filled('search')){
            $sorties->where('nom', 'LIKE', '%'. $request->input('search'). '%');
        }

        if($request->filled('date_debut') && $request->filled('date_fin')){
            $sorties->whereBetween('date_debut', [$request->input('date_debut'), $request->input('date_fin')]);
        }

        $sorties = $sorties->with(['participants', 'etat', 'lieu', 'campus', 'organisateur'])->paginate(10);

        return view('sorties.index', [
            'campusList' => $campusList,
            'user' => $user,
           'sorties' => $sorties,
        ]);
    }

    public function details($id){
        $sortie = Sortie::find($id);
        return view('sorties.details', ['sortie' => $sortie]);
    }

    public function subscribeToSortie($id){
        $sortie = Sortie::findOrFail($id);

        if (Auth::user()->sortiesInscrire()->where('sortie_id', $id)->exists()) {
            return redirect()->route('sorties.details', ['id' => $id])->with('error', 'Vous êtes déjà inscrit à cette sortie');
        }
        // Inscription à la sortie
        Auth::user()->sortiesInscrire()->attach($sortie);


        return redirect()->route('sorties.details', ['id' => $id])->with('success', 'Vous avez bien souscrit à la sortie');
    }
}
