@extends('layouts.template')

@section('title', 'Ajouter une référence')
@section('content')
    <div class="container mt-5">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4>Ajouter une Référence Juridique</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('references.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="">-- Sélectionner --</option>
                            <option value="Loi">Loi</option>
                            <option value="Décret">Décret</option>
                            <option value="Arrêté">Arrêté</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="objet" class="form-control @error('description') is-invalid @enderror" rows="5"></textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-success">Enregistrer</button>
                    <a href="{{ route('references.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
