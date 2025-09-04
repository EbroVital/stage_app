<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Deliberation;
use App\Models\Pdf as ModelsPdf;
use App\Models\Signataire;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use NumberToWords\NumberToWords;

function dateEnLettres($date)
{
    $carbonDate = Carbon::parse($date);
    $numberToWords = new NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('fr');
    // Jour
    $jour = $carbonDate->day == 1 ? "premier" : $numberTransformer->toWords($carbonDate->day);
    // Mois
    $mois = $carbonDate->translatedFormat('F'); // exemple : septembre
    // Année en lettres
    $annee = $numberTransformer->toWords($carbonDate->year);

    return " {$jour} {$mois} {$annee}";
}


function convertirMontantEnLettres($nombre)
{
    $formatter = new \NumberFormatter("fr", \NumberFormatter::SPELLOUT);
    return $formatter->format($nombre);
}

function heureEnLettres($time)
{
    $heure = \Carbon\Carbon::parse($time);
    return $heure->format('H') . ' heures ' . $heure->format('i') . ' minutes';
}

function heureLettres($heure)
{
    $carbonHeure = Carbon::parse($heure);
    $numberToWords = new NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('fr');
    $h = $carbonHeure->hour;
    $m = $carbonHeure->minute;
    $heures = $numberTransformer->toWords($h) . " heures";
    $minutes = $m > 0 ? " " . $numberTransformer->toWords($m) . " minutes" : "";

    return $heures . $minutes;
}




class PdfController extends Controller
{
    public function index()
    {
        return view('pdf.index');
    }


    public function getDocuments(Request $request){

        $type = $request->get('type');

        \Illuminate\Support\Facades\Log::info('Type reçu: ' . $type); // Log pour debug

        if ($type === 'avis') {
            $items = Avis::select('id', 'numero_avis', 'objet')->get();
        } elseif ($type === 'deliberation') {
            $items = Deliberation::select('id', 'numero', 'objet')->get();
        } else {
            $items = collect();
        }

         \Illuminate\Support\Facades\Log::info('Nombre d\'items trouvés: ' . $items->count()); // Log pour debug

        return response()->json($items);
    }

    // public function download($type, $id){

    //     if ($type == 'avis') {

    //         $document = Avis::with(['articles', 'referencesJuridiques', 'anneeBudgetaire', 'signataires'])->findOrFail($id);

    //         $heureDebut =  heureEnLettres($document->heure_debut);
    //         $heureFin =  heureEnLettres($document->heure_fin);
    //         $montant = convertirMontantEnLettres($document->montant);

    //         // Récupérer le président dans les signataires attachés
    //         $president = $document->signataires->firstWhere('pivot.fonction', 'Président');

    //         // Récupérer les autres signataires (sauf le président)
    //          $autresSignataires = Signataire::where('qualite', '<>' , 'Président du Conseil Régional')->get();

    //         $fileName = 'avis_'.$document->id.'.pdf';
    //         $filePath = storage_path('app/public/pdfs/' . $fileName);

    //         $pdf = Pdf::loadView('pdf.templates.avis', [
    //             'avis' => $document,
    //             'montant' => $montant,
    //             'heureDebut' => $heureDebut,
    //             'heureFin' => $heureFin,
    //             'president' => $president,
    //             'autresSignataires' => $autresSignataires
    //         ]);

    //         $pdf->save($filePath);

    //          // Sauvegarde en BDD
    //         ModelsPdf::create([
    //             'type' => 'avis',
    //             'filename' => $fileName,
    //             'path' => 'pdfs/'.$fileName,
    //             'user_id' => Auth::id(),
    //         ]);

    //         return $pdf->download($fileName);
    //     }
    //     elseif ($type == 'deliberation') {

    //         $doc = Deliberation::with(['articles', 'referencesJuridiques', 'anneeBudgetaire'])->findOrFail($id);

    //         $debut =  heureLettres($doc->heure_debut);
    //         $fin =  heureLettres($doc->heure_fin);
    //         $montantDelib = convertirMontantEnLettres($doc->montant);
    //         $date = $doc->date_proposition;
    //         $convocation = dateEnLettres($doc->date_convocation);
    //         $dateDelib = dateEnLettres($doc->created_at);

    //         // Récupérer le président dans les signataires attachés
    //         $signataire = $doc->signataires->firstWhere('pivot.fonction', 'Président');

    //         $file = 'deliberation_'.$doc->id.'.pdf';
    //         $filepath = storage_path('app/public/pdfs/' . $file);

    //         // TODO : créer un template Blade spécifique pour les délibérations
    //         $pdf = Pdf::loadView('pdf.templates.deliberation', [
    //             'deliberation' => $doc,
    //             'debut' => $debut,
    //             'fin' => $fin,
    //             'montantDelib' => $montantDelib,
    //             'signataire' => $signataire,
    //             'date' => $date,
    //             'date_convocation' => $convocation,
    //             'delib' => $dateDelib
    //         ]);

    //         $pdf->save($filepath);

    //         // Sauvegarde en BDD
    //         ModelsPdf::create([
    //             'type' => 'deliberation',
    //             'filename' => $file,
    //             'path' => 'pdfs/'.$filepath,
    //             'user_id' => Auth::id(),
    //         ]);

    //         return $pdf->download($file);
    //     }

    //     abort(404);
    // }

        public function download($type, $id){

        if ($type == 'avis') {

            $document = Avis::with(['articles', 'referencesJuridiques', 'anneeBudgetaire', 'signataires'])->findOrFail($id);

            $heureDebut = heureEnLettres($document->heure_debut);
            $heureFin = heureEnLettres($document->heure_fin);
            $montant = convertirMontantEnLettres($document->montant);

            // Récupérer le président
            $president = $document->signataires->firstWhere('pivot.fonction', 'Président');
            // Autres signataires
            $autresSignataires = Signataire::where('qualite', '<>', 'Président du Conseil Régional')->get();

            $pdf = Pdf::loadView('pdf.templates.avis', [
                'avis' => $document,
                'montant' => $montant,
                'heureDebut' => $heureDebut,
                'heureFin' => $heureFin,
                'president' => $president,
                'autresSignataires' => $autresSignataires
            ]);

            // Nom du fichier
            $fileName = 'avis_' . $document->id . '.pdf';
            $filePath = storage_path('app/public/pdfs/' . $fileName);

            // Sauvegarde physique
            $pdf->save($filePath);

            // Enregistrement en BDD
            ModelsPdf::create([
                'type' => 'avis',
                'filename' => $fileName,
                'path' => 'pdfs/' . $fileName, // pas de "storage/" ici
                'user_id' => auth()->id(),
            ]);

            // Téléchargement
            return response()->download($filePath);
        }

        elseif ($type == 'deliberation') {
            
            $doc = Deliberation::with(['articles', 'referencesJuridiques', 'anneeBudgetaire'])->findOrFail($id);

            $debut = heureLettres($doc->heure_debut);
            $fin = heureLettres($doc->heure_fin);
            $montantDelib = convertirMontantEnLettres($doc->montant);
            $date = $doc->date_proposition;
            $convocation = dateEnLettres($doc->date_convocation);
            $dateDelib = dateEnLettres($doc->created_at);

            $signataire = $doc->signataires->firstWhere('pivot.fonction', 'Président');

            $pdf = Pdf::loadView('pdf.templates.deliberation', [
                'deliberation' => $doc,
                'debut' => $debut,
                'fin' => $fin,
                'montantDelib' => $montantDelib,
                'signataire' => $signataire,
                'date' => $date,
                'date_convocation' => $convocation,
                'delib' => $dateDelib
            ]);

            $fileName = 'deliberation_' . $doc->id . '.pdf';
            $filePath = storage_path('app/public/pdfs/' . $fileName);

            $pdf->save($filePath);

            ModelsPdf::create([
                'type' => 'deliberation',
                'filename' => $fileName,
                'path' => 'pdfs/' . $fileName,
                'user_id' => auth()->id(),
            ]);

            return response()->download($filePath);
        }

        abort(404);
    }

}
