@extends('layouts.template')

@section('title', 'Ajouter une déliberation')
@section('content')
    <div class="container mt-5">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4>Nouvelle déliberation</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('deliberation.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="objet" class="form-label">Objet</label>
                        <input type="text" name="objet" class="form-control @error('objet') is-invalid @enderror">
                    </div>
                    @error('objet')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="date" class="form-label">Date de proposition de la deliberation</label>
                        <input type="date" name="date_proposition" id="date_proposition" class="form-control @error('date_proposition') is-invalid @enderror">
                    </div>
                    @error('date_proposition')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                     <div class="mb-3">
                        <label for="date" class="form-label">Date de la convocation écrite</label>
                        <input type="date" name="date_convocation" id="date_proposition" class="form-control @error('date_convocation') is-invalid @enderror">
                    </div>
                    @error('date_convocation')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="heure_debut" class="form-label">Heure de début</label>
                        <input type="time" name="heure_debut" id="heure_debut" class="form-control @error('heure_debut') is-invalid @enderror">
                    </div>
                    @error('heure_debut')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="heure_fin" class="form-label">Heure de fin</label>
                        <input type="time" name="heure_fin" id="heure_fin" class="form-control @error('heure_fin') is-invalid @enderror">
                    </div>
                    @error('heure_fin')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="entendu" class="form-label">Section "Entendu"</label>
                        <textarea name="entendu" id="entendu" class="form-control @error('entendu') is-invalid @enderror"></textarea>
                    </div>
                    @error('entendu')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant</label>
                        <input type="number" name="montant" class="form-control @error('montant') is-invalid @enderror" >
                    </div>
                    @error('montant')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <a href="{{ route('deliberation.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
