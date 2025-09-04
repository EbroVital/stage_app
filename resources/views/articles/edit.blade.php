@extends('layouts.template')

@section('title', 'Modifier un article')

@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h3>Modifier l'article {{ $article->numero }} </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('article.update', $article->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="contenu">Contenu</label>
                        <textarea name="contenu" id="contenu" rows="4" class="form-control" required>{{ old('contenu', $article->contenu) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                    <a href="{{ $type === 'avis' ? route('articles.avis.liste', ['avis' => $article->articleable_id]) : route('articles.deliberations.liste', ['deliberation' => $article->articleable_id]) }}" class="btn btn-secondary">Retour</a>

                </form>
            </div>
        </div>
    </div>
@endsection
