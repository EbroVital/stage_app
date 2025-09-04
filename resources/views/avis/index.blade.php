@extends('layouts.template')

@section('title', 'Liste des avis')
@section('content')
<div class="container mt-4">
    {{-- <h2 class="mb-4">Liste des avis</h2> --}}

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <a href="{{ route('avis.create') }}" class="btn btn-primary mb-3">Créer un nouvel avis</a>


    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Numéro</th>
                <th class="text-center">Objet</th>
                <th class="text-center">Bénéficiaire</th>
                <th class="text-center">Montant</th>
                <th class="text-center">Date</th>
                <th class="text-center">Président</th>
                <th class="text-center">Année budgétaire</th>
                <th class="text-center" colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avis as $key => $avi)
                <tr>
                    <td class="text-center">{{ $avi->numero_avis }}</td>
                    <td class="text-center">{{ $avi->objet }}</td>
                    <td class="text-center">{{ $avi->beneficiaire }}</td>
                    <td class="text-center">{{ number_format($avi->montant) }} FCFA</td>
                    <td class="text-center">{{ $avi->created_at->format('d/m/Y') }}
                    </td>
                    <td class="text-center">
                        @php
                            $president = $avi->signataires->first(function ($s) {
                                return strtolower($s->qualite) === 'président du conseil régional';
                            });
                        @endphp
                        {{ $president ? $president->nom : '—' }}
                    </td>
                    <td class="text-center">{{ $avi->anneeBudgetaire->libelle }}</td>
                    <td class="text-center">
                        <a href="{{ route('avis.edit', $avi) }}" class="btn btn-sm btn-warning" style="display:inline-block;">Modifier</a>

                        <a href="{{ route('article.create', ['type' => 'avis', 'id' => $avi->id]) }}" class="btn btn-sm btn-primary"> Ajout d'article </a>

                        <button class="btn btn-sm btn-danger" onclick="confirmerSuppression({{ $avi->id }})">Supprimer</button>

                        <form id="form-suppression-{{ $avi->id }}" action="{{ route('avis.destroy', $avi->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($avis->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">Aucun avis enregistré.</td>
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
