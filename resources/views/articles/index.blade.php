@extends('layouts.template')

@section('title', 'Liste des articles')

@section('content')
    <div class="container mt-4">
        <h3>Liste des articles
            @if($type === 'avis')
                liés aux Avis
            @else
                liés aux Délibérations
            @endif
        </h3>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3 table-striped">
            <thead class="table-dark">
                <tr>
                    {{-- <th>#</th> --}}
                    <th class="text-center">Numéro</th>
                    <th class="text-center">Contenu</th>
                    <th class="text-center">
                        @if($type === 'avis')
                            Avis lié
                        @else
                            Délibération liée
                        @endif
                    </th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $key => $article)
                <tr>
                    {{-- <td>{{ $key + 1 }}</td> --}}
                    <td class="text-center"> Article {{ $article->numero }}</td>
                    <td class="text-center">{{ $article->contenu }}</td>
                    <td class="text-center">
                        @if($type === 'avis')
                            Avis {{ $article->articleable->numero_avis }}
                        @else
                            Délibération {{ $article->articleable->numero }}
                        @endif
                    </td>
                    <td class="text-center">
                        <!-- Bouton Modifier -->
                        <a href="{{ route('article.edit', $article->id) }}" class="btn btn-sm btn-primary">Modifier</a>

                        <!-- Formulaire de suppression -->
                        <button class="btn btn-sm btn-danger" onclick="confirmerSuppression({{ $article->id }})">Supprimer</button>

                        <form id="form-suppression-{{ $article->id }}" action="{{ route('article.destroy', $article->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($articles->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">Aucun article enregistré.</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
@endsection


<script>
    function confirmerSuppression(id) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-suppression-' + id).submit();
            }
        });
    }
</script>
