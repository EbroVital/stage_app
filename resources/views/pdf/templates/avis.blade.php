{{-- resources/views/pdf/avis.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Avis du Bureau du Conseil Régional</title>

</head>
<body>

    {{-- ENTÊTE --}}
    <table class="header">
        <tr>
            <td style="text-align: left;">
                <i style="font-size: 8px; margin-left : 40px;"> KATD/KTM</i>
            </td>
        </tr>
        <tr>
            <td style="text-align: left;">
                <div style="font-weight: bold;">REGION DE L'INDENIE-DJUABLIN</div>
                <div style="margin-left : 20px;"> ....................... </div>
                <div class="img">
                    <img src="{{ public_path('img/LOGO.png') }}">
                </div>
            </td>
            <td style="text-align: right;">
                <div style="font-weight: bold;">REPUBLIQUE DE CÔTE D'IVOIRE</div>
                <div> <i style="margin-right: 25px;" >Union - Discipline - Travail</i> </div>
                <div style="margin-right: 75px;"> ................. </div>
            </td>
        </tr>
    </table>

    {{-- TITRE --}}
    <div class="title">
        <b> AVIS DU BUREAU DU CONSEIL RÉGIONAL {{ $avis->numero_avis }} du {{ $avis->created_at->translatedFormat('d F Y') }}  autorisant au titre de l'exercice {{ $avis->anneeBudgetaire->libelle}}, </b> l'engagement de la dépense d'un montant de <b> {{ $montant }} ({{ $avis->montant}}) FCFA </b> au compte de <b> {{ $avis->beneficiaire}}, </b> pour {{ $avis->objet }} .
    </div>

    {{-- INTRODUCTION --}}
    <div class="section">

        <p>
           <b> LE BUREAU DU CONSEIL REGIONAL DE L'INDENIE-DJUABLIN </b>
            <br> <b>
                Régulièrement constitué et réuni en séance ordinaire , le {{ $avis->created_at->translatedFormat('l d F Y') }} de {{ $heureDebut }} à {{ $heureFin }}, au siège du Conseil Régional à Abengourou, sous la présidence de Monsieur {{ $president->nom }}, Président du Bureau du Conseil Régional de l'Indénié-Djuablin.
            </b>
        </p>

    </div>

    {{-- RÉFÉRENCES JURIDIQUES --}}
    <div class="section">
        @foreach($avis->referencesJuridiques as $ref)
           <b>Vu </b>    {{ $ref->description  }} ;<br>
        @endforeach
        <br>
        <b>Vu le procès verbal de la mise en place des organes du Conseil en date du 28 septembre 2023 ;</b>
    </div>

    <div class="section">
        <b>Entendu</b>  {{ $avis->entendu}} .
    </div>

    {{-- DECISION --}}
    <p> A la majorité des membres présents à la séance :</p>
    <div class="decide">DECIDE</div>
    @foreach($avis->articles as $index => $article)
        <div class="section">
            <strong>
                @if ( $index === 0 )
                     <u>Article premier</u> :
                @else
                    <u>Article {{ $index + 1 }}</u> :
                @endif
            </strong> {{ $article->contenu }}
        </div>
    @endforeach

    <p align="right">
        <b> Fait à Abengourou, le {{ $avis->created_at->translatedFormat('d F Y') }} </b>
    </p>

    {{-- SIGNATURES --}}
    <table class="signatures">

        <tr>
            <td class="signature-cell">
                Le Secrétaire de séance<br>
                Le Directeur Général d'Administration<br>
            </td>

            <td class="signature-cell">
                Le Président de séance<br>
                Le Président du Conseil Régional<br>
            </td>
        </tr>
        <tr>
            <td><b><u> OUASSOLOU Gnékpa</u>  </b>  </td>
            <td> <b> <u> {{ $president->nom }}</u>  </b>  </td>
        </tr>
    </table>

    {{-- TABLEAU DES MEMBRES --}}
    <h4 style="margin-top: 30px;" align="center">Avis {{ $avis->numero_avis }} des membres du Bureau</h4>
    <table class="membres">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nom et prénoms</th>
                <th>Qualité</th>
                <th>Avis</th>
                <th>Signature</th>
            </tr>
        </thead>
        <tbody>
            @foreach($autresSignataires as  $signataire)
                <tr>
                    <td>{{ $signataire->id - 1 }}</td>
                    <td>{{ $signataire->nom }}</td>
                    <td>{{ $signataire->qualite }}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

 <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12.5px;
            line-height: 1.5;
        }
        .header {
            width: 100%;
            text-align: center;
        }
        .header td {
            vertical-align: top;
            width: 50%;
        }
        .title {
            text-align: justify;
            margin: 10px 0;
        }
        .section {
            margin-top: 10px;
            text-align: justify;
        }
        .decide {
            text-align: center;
            font-weight: bold;
            letter-spacing: 3px;
            /* text-decoration: underline 2px black solid; */
            text-decoration: underline;
            text-decoration-color: black;
            margin: 15px 0;
        }
        table.signatures, table.membres {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table.membres th, table.membres td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            font-size: 11px;
        }
        .signature-cell {
            text-align: justify;
            vertical-align: top;
        }
        .img img{
            max-height: 80px;
            margin-left: 20;
        }

    </style>
