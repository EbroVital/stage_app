@extends('layouts.template')

@section('title', 'Liste des références juridiques')
@section('content')
    <div class="container">
        <h2 class="mb-4">Liste des Références Juridiques</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <a href="{{ route('references.create') }}" class="btn btn-primary mb-3"> Ajouter une Référence</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Type</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Date d'ajout</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($references as $reference)
                    <tr>
                        <td class="text-center">{{ $reference->type }}</td>
                        <td class="text-center">{{ $reference->description }}</td>
                        <td class="text-center">{{ $reference->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">

                            <a href="{{ route('references.edit', $reference) }}" class="btn btn-sm btn-primary">Modifier</a>

                            <button class="btn btn-sm btn-danger" onclick="confirmerSuppression({{ $reference->id }})">Supprimer</button>

                            <form id="form-suppression-{{ $reference->id }}" action="{{ route('references.destroy', $reference->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                        </td>
                    </tr>
                @endforeach

                @if($references->isEmpty())
                    <tr><td colspan="5" class="text-center">Aucune référence trouvée.</td></tr>
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
