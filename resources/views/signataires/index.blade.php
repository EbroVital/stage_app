@extends('layouts.template')

@section('title', 'Liste des Elus')
@section('content')
    <div class="container mt-4">
        {{-- <h2>Liste des Signataires</h2> --}}
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <a href="{{ route('signataires.create') }}" class="btn btn-primary mb-3">Ajouter un Elu</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Nom & Prénom(s)</th>
                    <th class="text-center">Qualité</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($signataires as $signataire)
                    <tr>
                        <td class="text-center">{{ $signataire->nom }}</td>
                        <td class="text-center">{{ $signataire->qualite }}</td>
                        <td class="text-center">
                            <a href="{{ route('signataires.edit', $signataire->id) }}" class="btn btn-primary btn-sm">Modifier</a>

                            <button class="btn btn-sm btn-danger" onclick="confirmerSuppression({{ $signataire->id }})">Supprimer</button>

                            <form id="form-suppression-{{ $signataire->id}}" action="{{ route('signataires.destroy', $signataire->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            {{-- <form action="{{ route('signataires.destroy', $signataire->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce signataire ?')">Supprimer</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach

                @if($signataires->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">Aucun Elu enregistré.</td>
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
