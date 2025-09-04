@extends('layouts.template')

@section('title', 'Créer un nouvel avis')

{{-- @section('content')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('avis.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="objet" class="form-label">Objet</label>
                <input type="text" class="form-control" id="objet" name="objet" required>
            </div>

            <div class="mb-3">
                <label for="montant" class="form-label">Montant</label>
                <input type="number" class="form-control" id="montant" name="montant" required>
            </div>

            <div class="mb-3">
                <label for="beneficiaire" class="form-label">Bénéficiaire</label>
                <input type="text" class="form-control" id="beneficiaire" name="beneficiaire" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>


@endsection --}}

@section('content')
    <div class="container mt-5">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4>Créer un nouvel avis</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('avis.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="objet" class="form-label">Objet</label>
                        <input type="text" class="form-control @error('objet') is-invalid @enderror" id="objet" name="objet" value="{{ old('objet') }}" >
                    </div>
                    @error('objet')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="beneficiaire" class="form-label">Bénéficiaire</label>
                        <input type="text" class="form-control @error('beneficiaire') is-invalid @enderror" id="beneficiaire" name="beneficiaire" value="{{ old('beneficiaire') }}" >
                    </div>
                    @error('beneficiaire')
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
                        <label for="montant" class="form-label">Montant (FCFA)</label>
                        <input type="number" class="form-control @error('montant') is-invalid @enderror" id="beneficiaire" id="montant" name="montant" value="{{ old('montant') }}" >
                    </div>
                    @error('montant')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror


                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <a href="{{ route('avis.index') }}" class="btn btn-secondary ">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection





