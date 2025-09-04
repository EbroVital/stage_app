@extends('layouts.template')

@section('title', 'Modifier une déliberation')
@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-4">Modifier la déliberation : {{ $deliberation->numero }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('deliberation.update', $deliberation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="objet" class="form-label">Objet</label>
                        <input type="text" name="objet" value="{{ $deliberation->objet }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="heure_debut" class="form-label">Heure de début</label>
                        <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="{{ old('heure_debut', $deliberation->heure_debut) }}">
                    </div>

                     <div class="mb-3">
                        <label for="heure_fin" class="form-label">Heure de fin</label>
                        <input type="time" name="heure_fin" id="heure_fin" class="form-control" value="{{ old('heure_fin', $deliberation->heure_fin)}}">
                    </div>

                    <div class="mb-3">
                        <label for="entendu" class="form-label">Section "Entendu"</label>
                        <textarea name="entendu" id="entendu" class="form-control">{{ old('entendu', $deliberation->entendu) }}
                        </textarea>
                    </div>

                     <div class="mb-3">
                        <label for="date" class="form-label">Date de proposition de la deliberation</label>
                        <input type="date" name="date" id="heure_debut" class="form-control" value="{{ old('date_proposition', $deliberation->date_proposition) }}">
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date de la convocation écrite</label>
                        <input type="date" name="date" id="heure_debut" class="form-control" value="{{ old('date_convocation', $deliberation->date_convocation) }}">
                    </div>

                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant</label>
                        <input type="number" name="montant" value="{{ $deliberation->montant }}" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('deliberation.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
