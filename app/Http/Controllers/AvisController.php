<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormAvisRequest;
use App\Models\AnneeBudgetaire;
use App\Models\Avis;
use App\Models\ReferenceJuridique;
use App\Models\Signataire;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    // liste des avis
    public function index(){
        $avis = Avis::with('anneeBudgetaire')->latest()->get();
        return view('avis.index', compact('avis'));
    }

    // le formulaire de creation d'un avis
    public function create(){
        return view('avis.create');
    }

    // Enregistre un nouvel avis
    public function store(FormAvisRequest $request){

        // Récupérer ou créer l’année budgétaire en cours
        $anneeBudgetaire = AnneeBudgetaire::firstOrCreate([
            'libelle' => date('Y'),
        ]);

        // Générer le numéro d'avis
        $numeroOrdre = Avis::where('annee_budgetaire_id', $anneeBudgetaire->id)->count() + 1;
        $numeroFormatte = str_pad($numeroOrdre, 3, '0', STR_PAD_LEFT);
        $numero = 'N°' . $anneeBudgetaire->libelle . '-' . $numeroFormatte . '/RID/CR/DGA';

        // Création de l'avis
        $avis = new Avis();
        $avis->objet = $request->objet;
        $avis->montant = $request->montant;
        $avis->beneficiaire = $request->beneficiaire;
        $avis->numero_avis = $numero;
        $avis->entendu = $request->entendu;
        $avis->heure_debut = $request->heure_debut;
        $avis->heure_fin = $request->heure_fin;
        $avis->annee_budgetaire_id = $anneeBudgetaire->id;
        $avis->save();

        $avis->refresh();

        // Recherche du président insensible à la casse
        $president = Signataire::whereRaw('LOWER(qualite) = ?', ['président du conseil régional'])->first();

        if ($president) {
            $avis->signataires()->attach($president->id, [
                'fonction' => 'Président',
                'ordre' => 1,
            ]);
        }

        // Récupération de toutes les références juridiques
        $references = ReferenceJuridique::all();

        // Association de toutes les références juridiques à cet avis
        if ($references->count() > 0) {
            $avis->referencesJuridiques()->attach($references->pluck('id')->toArray());
        }

        return redirect()->route('avis.index')->with('success', 'Avis créé avec succès !');

    }

    // Show the form for editing the specified resource.

    public function edit(Avis $avis)
    {
        return view('avis.edit', compact('avis'));

    }

    // Update the specified resource in storage.

    public function update(Request $request, Avis $avis)
    {
        $avis->update([
            'objet' => $request->objet,
            'beneficiaire' => $request->beneficiaire,
            'montant' => $request->montant,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'entendu' => $request->entendu
        ]);

        return redirect()->route('avis.index')->with('success', 'Avis mis à jour avec succès.');
    }

    // Remove the specified resource from storage.
    public function destroy(Avis $avis)
    {
        $avis->delete();
        return redirect()->route('avis.index')->with('success', 'Avis supprimé.');
    }


}
