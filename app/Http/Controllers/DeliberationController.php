<?php

namespace App\Http\Controllers;

use App\Http\Requests\deliberationRequest;
use App\Models\AnneeBudgetaire;
use App\Models\Deliberation;
use App\Models\ReferenceJuridique;
use App\Models\Signataire;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliberationController extends Controller
{
    public function index()
    {
        $deliberations = Deliberation::latest()->get();
        return view('deliberations.index', compact('deliberations'));
    }

    public function create()
    {
        $annee = AnneeBudgetaire::firstOrCreate(
            ['libelle' => Carbon::now()->year]
        );
        return view('deliberations.create', compact('annee'));
    }

    public function store(deliberationRequest $request){

         $annee = AnneeBudgetaire::firstOrCreate(
            ['libelle' => Carbon::now()->year]
        );

        $dernierNumero = Deliberation::where('annee_budgetaire_id', $annee->id)->count() + 1;
        $numero_formatte = str_pad($dernierNumero, 3, '0', STR_PAD_LEFT);

        $numero = 'N°' . $annee->libelle . '-' . $numero_formatte . '/RID/CR/DGA';

         $deliberation = Deliberation::create([
            'objet' => $request->objet,
            'montant' => $request->montant,
            'numero' => $numero,
            'entendu' => $request->entendu,
            'heure_debut'=> $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'date_proposition' => $request->date_proposition,
            'date_convocation' => $request->date_convocation,
            'annee_budgetaire_id' => $annee->id,
        ]);

        // Recherche du président insensible à la casse
        $president = Signataire::whereRaw('LOWER(qualite) = ?', ['président du conseil régional'])->first();

        if ($president) {
            $deliberation->signataires()->attach($president->id, [
                'fonction' => 'Président',
                'ordre' => 1,
            ]);
        }

        // Récupération de toutes les références juridiques
        $references = ReferenceJuridique::all();

        // Association de toutes les références juridiques à cet avis
        if ($references->count() > 0) {
            $deliberation->referencesJuridiques()->attach($references->pluck('id')->toArray());
        }

        return redirect()->route('deliberation.index')->with('success', 'Délibération ajoutée avec succès');

    }

    public function edit(Deliberation $deliberation)
    {
        return view('deliberations.edit', compact('deliberation'));
    }

    public function update(Request $request, Deliberation $deliberation)
    {

        $deliberation->update($request->only('objet', 'beneficiaire', 'montant'));

        return redirect()->route('deliberation.index')->with('success', 'Délibération modifiée avec succès');
    }

    public function destroy(Deliberation $deliberation)
    {
        $deliberation->delete();
        return redirect()->route('deliberation.index')->with('success', 'Délibération supprimée avec succès');
    }

}
