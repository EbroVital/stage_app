<?php

namespace App\Http\Controllers;

use App\Http\Requests\signataireRequest;
use App\Models\Avis;
use App\Models\Deliberation;
use App\Models\Signataire;
use Illuminate\Http\Request;

class SignataireController extends Controller
{
    public function index()
    {
        $signataires = Signataire::all();
        return view('signataires.index', compact('signataires'));
    }

    public function create()
    {
        return view('signataires.create');
    }

    public function store(Request $request)
    {
         Signataire::create($request->only('nom', 'qualite'));
        // if ($request->type === 'avis') {
        //     $signataire->avis()->attach($request->id, [
        //         'fonction' => $request->fonction,
        //         'ordre' => $request->ordre
        //     ]);
        // } elseif ($request->type === 'deliberation') {
        //     $signataire->deliberations()->attach($request->id, [
        //         'fonction' => $request->fonction,
        //         'ordre' => $request->ordre
        //     ]);
        // }

        return redirect()->route('signataires.index')->with('success', 'Signataire ajouté avec succès.');
    }

    public function edit($id)
    {
        $signataire = Signataire::findOrFail($id);
        return view('signataires.edit', compact('signataire'));
    }

    public function update(Request $request, $id)
    {
        $signataire = Signataire::findOrFail($id);
        $signataire->update($request->only('nom', 'qualite'));
        // if ($request->type === 'avis') {
        //     $signataire->avis()->updateExistingPivot($request->id, [
        //         'fonction' => $request->fonction,
        //         'ordre' => $request->ordre
        //     ]);
        // } elseif ($request->type === 'deliberation') {
        //     $signataire->deliberations()->updateExistingPivot($request->id, [
        //         'fonction' => $request->fonction,
        //         'ordre' => $request->ordre
        //     ]);
        // }

        return redirect()->route('signataires.index')->with('success', 'Signataire modifié avec succès.');
    }

    public function destroy($id)
    {
        $signataire = Signataire::findOrFail($id);

        // if ($type === 'avis') {
        //     $signataire->avis()->detach($objId);
        // } elseif ($type === 'deliberation') {
        //     $signataire->deliberations()->detach($objId);
        // }
        // Optionnel : suppression définitive si plus aucun lien
        // if ($signataire->avis()->count() === 0 && $signataire->deliberations()->count() === 0) {
        //     $signataire->delete();
        // }
        $signataire->delete();

        return redirect()->route('signataires.index')->with('success', 'Signataire supprimé avec succès.');
    }

}
