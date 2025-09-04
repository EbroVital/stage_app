@extends('layouts.template')

@section('title', 'Ajouter les articles')
@section('content')
    <div class="container mt-5">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                @if( $type == 'avis')
                    <h3> Ajout des articles pour l'{{ $type }} {{$avis->numero_avis}}</h3>
                @else
                    <h3> Ajout des articles pour la {{ $type }} {{$deliberation->numero}}</h3>
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('article.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="parent_id" value="{{ $id }}">

                    @if ($type === 'avis')
                        {{-- ARTICLE 1 --}}
                        <div class="mb-3">
                            <label>Article 1</label>
                            <textarea name="contenus[]" class="form-control" rows="4" readonly>Est autorisé au titre de l'exercice {{ $avis->anneeBudgetaire->libelle }}, l'engagement de la dépense d'un montant de {{ $montantAvis }} ({{ $avis->montant }}) de francs CFA au compte de {{ $avis->beneficiaire }} pour {{ $avis->objet }}.
                            </textarea>
                        </div>

                        {{-- ARTICLE 2 --}}
                        <div class="mb-3">
                            <label>Article 2</label>
                            <textarea name="contenus[]" class="form-control" rows="4"> La dépense qui s'élève à un montant de {{ $montantAvis }} ({{ $avis->montant }}) de francs CFA est imputable à la section .. , chapitre .. , article ../.. de l'exercice {{ $avis->anneeBudgetaire->libelle }} de la Région de l'Indénié-Djuablin.
                            </textarea>
                        </div>

                        {{-- ARTICLE 3 --}}
                        <div class="mb-3">
                            <label>Article 3</label>
                            <textarea name="contenus[]" class="form-control" rows="4" readonly>Le Président et le Payeur de la Région de l'Indénié-Djuablin sont chargés, chacun en ce qui le concerne, de l'exécution du présent avis, qui prend effet à compter de la date de signature.
                            </textarea>
                        </div>

                    @elseif ($type === 'deliberation')
                        {{-- ARTICLE 1 --}}
                        <div class="mb-3">
                            <label>Article 1</label>
                            <textarea name="contenus[]" class="form-control" rows="3" readonly>Est autorisé {{ $deliberation->objet }}
                            </textarea>
                        </div>

                        {{-- ARTICLE 2 --}}
                        <div class="mb-3">
                            <label>Article 2</label>
                            <textarea name="contenus[]" class="form-control" rows="4">La dépense qui s'élève à un montant de {{ $montant }} ({{ $deliberation->montant }}) de francs CFA est imputable à la section .. , chapitre .. , article ../.. du budget ...  de l'exercice {{ $deliberation->anneeBudgetaire->libelle}} de la Région de l'Indénié-Djuablin.
                            </textarea>
                        </div>

                        {{-- ARTICLE 3 --}}
                        <div class="mb-3">
                            <label>Article 3</label>
                            <textarea name="contenus[]" class="form-control" rows="4" readonly>Le Président et le Payeur de la Région de l'Indénié-Djuablin sont chargés, chacun en ce qui le concerne, de l'exécution de la présente délibération après son approbation par l'autorité de tutelle.
                            </textarea>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-success">Enregistrer les articles</button>
                </form>
            </div>
        </div>
    </div>
@endsection
