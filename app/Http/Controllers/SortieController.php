<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Etat;
use App\Models\Lieu;
use App\Models\Sortie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SortieController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $campusList = Campus::all();
        $user = Auth::user();

        //initialisattion de la requette avec pagination
        $sorties = Sortie::query();

        if ($request->filled('campus')) {
            $sorties->where('campus_id', $request->input('campus'));
        }

        if ($request->filled('search')) {
            $sorties->where('nom', 'LIKE', '%' . $request->input('search') . '%');
        }

        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $sorties->whereBetween('date_debut', [$request->input('date_debut'), $request->input('date_fin')]);
        }

        $sorties = $sorties->with(['participants', 'etat', 'lieu', 'campus', 'organisateur'])->paginate(10);

        return view('sorties.index', [
            'campusList' => $campusList,
            'user' => $user,
            'sorties' => $sorties,
        ]);
    }

    public function details($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $sortie = Sortie::find($id);
        return view('sorties.details', ['sortie' => $sortie]);
    }

    public function subscribeToSortie($id): \Illuminate\Http\RedirectResponse
    {
        $sortie = Sortie::findOrFail($id);

        if (Auth::user()->sortiesInscrire()->where('sortie_id', $id)->exists()) {
            return redirect()->route('sorties.details', ['id' => $id])->with('error', 'Vous êtes déjà inscrit à cette sortie');
        }
        // Inscription à la sortie
        Auth::user()->sortiesInscrire()->attach($sortie);


        return redirect()->route('sorties.details', ['id' => $id])->with('success', 'Vous avez bien souscrit à la sortie');
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {

        $campusList = Campus::all();
        $LieuxList = Lieu::with('ville')->get();
        $villesList = $LieuxList->pluck('ville')->unique();
        return view('sorties.create', [
            'campusList' => $campusList,
            'lieuxList' => $LieuxList,
            'villesList' => $villesList,
        ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::user()) {
            return redirect()->route('login')->withErrors(['auth' => 'Vous devez être connecté pour créer une sortie.']);
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'dateHeureDebut' => 'required|date|after:now',
            'dateLimiteInscription' => 'required|date|before:dateHeureDebut|after:now',
            'nbInscriptionsMax' => 'required|integer|min:1',
            'duree' => 'required|integer|min:1',
            'infosSortie' => 'nullable|string',
            'campus_id' => 'required|exists:campuses,id',
            'lieu_id' => 'required|exists:lieus,id',
        ],
            [
                'nom.required' => 'Le nom de la sortie est obligatoire.',
                'dateHeureDebut.required' => 'La date et l\'heure de début sont obligatoires.',
                'dateHeureDebut.date' => 'La date de début doit être une date valide.',
                'dateHeureDebut.after' => 'La date de début doit être postérieure à la date actuelle.',
                'dateLimiteInscription.required' => 'La date limite d\'inscription est obligatoire.',
                'dateLimiteInscription.date' => 'La date limite d\'inscription doit être une date valide.',
                'dateLimiteInscription.before' => 'La date limite d\'inscription doit être avant la date de début.',
                'dateLimiteInscription.after' => 'La date limite d\'inscription doit être postérieure à aujourd\'hui.',
                'nbInscriptionsMax.required' => 'Le nombre maximum d\'inscriptions est obligatoire.',
                'nbInscriptionsMax.integer' => 'Le nombre maximum d\'inscriptions doit être un nombre entier.',
                'nbInscriptionsMax.min' => 'Le nombre maximum d\'inscriptions doit être supérieur à zéro.',
                'duree.required' => 'La durée de la sortie est obligatoire.',
                'duree.integer' => 'La durée de la sortie doit être un entier.',
                'duree.min' => 'La durée doit être supérieure à zéro.',
                'campus_id.required' => 'Le campus est obligatoire.',
                'campus_id.exists' => 'Le campus sélectionné est invalide.',
                'lieu_id.required' => 'Le lieu est obligatoire.',
                'lieu_id.exists' => 'Le lieu sélectionné est invalide.',
            ]);

        //rajouter l'état de la sortie en récuperant l'état 'en creation' en basse de donner
        $etat = Etat::firstOrCreate(['libelle' => 'En création']);

        $sortie = new Sortie($validated);
        $sortie->etat()->associate($etat);
        $sortie->organisateur()->associate(Auth::user());
        $sortie->save();


        return redirect()->route('sorties.index')->with('success', 'La sortie a bien été créée');
    }
}
