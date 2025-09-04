@extends('layouts.template')

@section('title', 'Editer une référence juridique')
@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-4">Modifier une Référence Juridique</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('references.update', $reference) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="Loi" {{ $reference->type == 'Loi' ? 'selected' : '' }}>Loi</option>
                            <option value="Décret" {{ $reference->type == 'Décret' ? 'selected' : '' }}>Décret</option>
                            <option value="Arrêté" {{ $reference->type == 'Arrêté' ? 'selected' : '' }}>Arrêté</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="objet" class="form-label">Description</label>
                        <textarea name="objet" id="objet" class="form-control" rows="3">{{ $reference->description }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('references.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
