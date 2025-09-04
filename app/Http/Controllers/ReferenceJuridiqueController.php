<?php

namespace App\Http\Controllers;

use App\Http\Requests\referenceRequest;
use App\Models\Avis;
use App\Models\Deliberation;
use App\Models\ReferenceJuridique;
use Illuminate\Http\Request;

class ReferenceJuridiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $references = ReferenceJuridique::latest()->get();
        return view('references.index', compact('references'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('references.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(referenceRequest $request)
    {

        ReferenceJuridique::create($request->all());

        return redirect()->route('references.index')->with('success', 'Référence juridique ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReferenceJuridique $reference)
    {
        return view('references.edit', compact('reference'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReferenceJuridique $reference)
    {
        $reference->update($request->all());
        return redirect()->route('references.index')->with('success', 'Référence mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReferenceJuridique $reference)
    {
        $reference->delete();
        return redirect()->route('references.index')->with('success', 'Référence supprimée.');
    }

    // Association à un Avis
    public function attachToAvis(Request $request, $referenceId)
    {
        $reference = ReferenceJuridique::findOrFail($referenceId);
        $avis = Avis::findOrFail($request->avis_id);

        $reference->avis()->syncWithoutDetaching([$avis->id]);

        return back()->with('success', "Référence liée à l\'avis.");
    }

    // Association à une Délibération
    public function attachToDeliberation(Request $request, $referenceId)
    {
        $reference = ReferenceJuridique::findOrFail($referenceId);
        $deliberation = Deliberation::findOrFail($request->deliberation_id);

        $reference->deliberations()->syncWithoutDetaching([$deliberation->id]);

        return back()->with('success', 'Référence liée à la délibération.');
    }
}
