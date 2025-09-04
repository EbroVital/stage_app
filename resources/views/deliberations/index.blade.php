@extends('layouts.template')

@section('title', 'Liste des délibérations')
@section('content')
<div class="container">
    {{-- <h2 class="mb-4">Liste des Délibérations</h2> --}}
    <a href="{{ route('deliberation.create') }}" class="btn btn-primary mb-3">Nouvelle Délibération</a>



    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Numéro</th>
                <th class="text-center">Objet</th>
                <th class="text-center">Montant</th>
                 <th class="text-center">Date</th>
                <th class="text-center">Président</th>
                 <th class="text-center">Année budgétaire</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deliberations as $deliberation)
                <tr>
                    <td class="text-center">{{ $deliberation->numero }}</td>
                    <td class="text-center">{{ $deliberation->objet }}</td>
                    <td class="text-center">{{ number_format($deliberation->montant, 0, ',', ' ') }} FCFA</td>
                    <td class="text-center">{{ $deliberation->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        @php
                            $president = $deliberation->signataires->first(function ($s) {
                                return strtolower($s->qualite) === 'président du conseil régional';
                            });
                        @endphp
                        {{ $president ? $president->nom : '—' }}
                    </td>
                    <td class="text-center">{{ $deliberation->anneeBudgetaire->libelle }}</td>
                    <td class="text-center">
                        <a href="{{ route('deliberation.edit', $deliberation->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                        <a href="{{ route('article.create', ['type' => 'deliberation', 'id' => $deliberation->id]) }}" class="btn btn-sm btn-primary">Ajout d'article </a>

                        <button class="btn btn-sm btn-danger" onclick="confirmerSuppression({{ $deliberation->id }})">Supprimer</button>

                        <form id="form-suppression-{{ $deliberation->id }}" action="{{ route('deliberation.destroy', $deliberation->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($deliberations->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">Aucune déliberation enregistrée.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- SweetAlert2 -->

@endsection

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script>
    // document.querySelectorAll('.delete-form').forEach(form => {
    //     form.addEventListener('submit', function (e) {
    //         e.preventDefault();

    //         Swal.fire({
    //             title: 'Êtes-vous sûr ?',
    //             text: "Cette action est irréversible !",
    //             icon: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: 'Oui, supprimer !',
    //             cancelButtonText: 'Annuler'
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 form.submit();
    //             }
    //         });
    //     });
    // });

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
