{{-- resources/views/pdf/avis.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Délibération du Conseil Régional</title>

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
                 <b>CONSEIL REGIONAL</b>
                 <div style="margin-left : 20px;"> ....................... </div>
                  <b style="font-size: 10px;">DIRECTION GENERALE D'ADMINISTRATION</b>
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
        <b> DELIBERATION DU CONSEIL RÉGIONAL {{ $deliberation->numero }} du {{ strtoupper ($deliberation->created_at->translatedFormat('d F Y'))   }}  PORTANT {{ strtoupper($deliberation->objet)  }} .
    </div>

    {{-- INTRODUCTION --}}
    <div class="section">

        <p>
           <b> LE CONSEIL REGIONAL DE L'INDENIE-DJUABLIN, </b>
            <br>
                Régulièrement convoqué et réuni en séance publique , le {{ $delib }} de {{ $debut }} à {{ $fin }}, dans la salle de réunion du Conseil Régional , sur convocation écrite en date {{ $date_convocation }} du  sous la présidence de Monsieur {{ $signataire->nom }}, le Président dudit Conseil ;
        </p>

    </div>

    <p> Le quorum étant atteint ainsi que l'atteste la liste émargée de présences jointe en annexe ; </p>

    {{-- RÉFÉRENCES JURIDIQUES --}}
    <div class="section">
        @foreach($deliberation->referencesJuridiques as $ref)
           <b>Vu </b>    {{ $ref->description  }} ;<br>
        @endforeach
        <br>
        <b>Sur proposition du Bureau du Conseil Régional en sa séance du {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}
 ;</b>
    </div>

    <div class="section">
        <b>Entendu</b>  {{ $deliberation->entendu }} .
    </div>

    {{-- DECISION --}}
    <div class="decide">DECIDE</div>
    @foreach($deliberation->articles as $index => $article)
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
        <b> Délibéré à Abengourou, le {{ $deliberation->created_at->translatedFormat('d F Y') }} </b>
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
            <td> <b> <u> {{ $signataire->nom }}</u>  </b>  </td>
        </tr>
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
            border: 1px solid black;
            padding: 10px;
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
