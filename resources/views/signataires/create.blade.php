@extends('layouts.template')

@section('title', 'Ajouter un Elu')
@section('content')
    <div class="container mt-5">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4>Ajouter un Elu</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('signataires.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom & Prénom(s)</label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror">
                    </div>
                    @error('nom')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="qualite" class="form-label">Qualité</label>
                        <select name="qualite" id="qualite" class="form-control @error('qualite') is-invalid @enderror">
                            <option value="">-- Sélectionner une qualité --</option>
                            <option value="Président du Conseil Régional">Président du Conseil Régional</option>
                            <option value="1er Vice-président">1er Vice-président</option>
                            <option value="2eme Vice-président">2eme Vice-président</option>
                            <option value="3eme Vice-président">3eme Vice-président</option>
                            <option value="4eme Vice-président">4eme Vice-président</option>
                            <option value="5eme Vice-président">5eme Vice-président</option>
                        </select>
                    </div>
                    @error('qualite')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
