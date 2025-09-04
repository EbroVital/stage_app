@extends('layouts.template')

@section('title', 'Modifier un avis')
@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-4">Modifier l'avis : {{ $avis->numero_avis }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('avis.update', $avis) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="objet" class="form-label">Objet</label>
                        <input type="text" name="objet" id="objet" class="form-control" value="{{ old('objet', $avis->objet) }}" >
                    </div>

                    <div class="mb-3">
                        <label for="beneficiaire" class="form-label">Bénéficiaire</label>
                        <input type="text" name="beneficiaire" id="beneficiaire" class="form-control" value="{{ old('beneficiaire', $avis->beneficiaire) }}" >
                    </div>

                    <div class="mb-3">
                        <label for="heure_debut" class="form-label">Heure de début</label>
                        <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="{{ old('heure_debut', $avis->heure_debut) }}">
                    </div>

                    <div class="mb-3">
                        <label for="heure_fin" class="form-label">Heure de fin</label>
                        <input type="time" name="heure_fin" id="heure_fin" class="form-control" value="{{ old('heure_fin', $avis->heure_fin)}}">
                    </div>

                    <div class="mb-3">
                        <label for="entendu" class="form-label">Section "Entendu"</label>
                        <textarea name="entendu" id="entendu" class="form-control">{{ old('entendu', $avis->entendu) }}
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant (en FCFA)</label>
                        <input type="number" name="montant" id="montant" class="form-control" value="{{ old('montant', $avis->montant) }}"  min="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('avis.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>

    </div>
@endsection
