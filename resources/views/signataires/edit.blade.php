@extends('layouts.template')

@section('title', "Modification d'un Elu")
@section('content')
    <div class="container mt-5">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-4">Modifier un Signataire</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('signataires.update', $signataire->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ $signataire->nom }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="qualite" class="form-label">Qualité</label>
                        <select name="qualite" id="qualite" class="form-control @error('qualite') is-invalid @enderror">
                            <option value="">-- Sélectionner une qualité --</option>
                            <option value="Président du Conseil Régional" {{ $signataire->qualite == 'Président du Conseil Régional' ? 'selected' : '' }}>Président du Conseil Régional</option>
                            <option value="1er Vice-président" {{ $signataire->qualite == '1er Vice-président' ? 'selected' : '' }}>1er Vice-président</option>
                            <option value="2eme Vice-président" {{ $signataire->qualite == '2eme Vice-président' ? 'selected' : '' }}>2eme Vice-président</option>
                            <option value="3eme Vice-président" {{ $signataire->qualite == '3eme Vice-président' ? 'selected' : '' }}>3eme Vice-président</option>
                            <option value="4eme Vice-président" {{ $signataire->qualite == '4eme Vice-président' ? 'selected' : '' }}>4eme Vice-président</option>
                            <option value="5eme Vice-président" {{ $signataire->qualite == '5eme Vice-président' ? 'selected' : '' }}>5eme Vice-président</option>
                        </select>
                    </div>
                    @error('qualite')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                    <a href="{{ route('signataires.index')}}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
