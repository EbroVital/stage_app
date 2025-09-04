<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Deliberation;
use App\Models\AnneeBudgetaire;
use App\Models\Pdf;
use App\Models\ReferenceJuridique;
use App\Models\Signataire;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){

        // Récupération de l'année sélectionnée (ou année en cours par défaut)
        $annee = $request->input('annee', date('Y'));

        // Statistiques globales
        $totalAvis = Avis::count();
        $totalDeliberations = Deliberation::count();

        // Nombre total de références juridiques
        $totalReferences = ReferenceJuridique::count();

        // Récupération du président
        $president = Signataire::where('qualite', 'Président du Conseil Régional')->first();

        // Statistiques par année
        $avisAnnee = Avis::whereYear('created_at', $annee)->count();
        $deliberationsAnnee = Deliberation::whereYear('created_at', $annee)->count();

        // Avis par mois
        $avisParMois = Avis::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )->groupBy('mois')->pluck('total', 'mois');

        // Délibérations par mois
        $delibParMois = Deliberation::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )->groupBy('mois')->pluck('total', 'mois');

        //  Labels mois
        $mois = collect(range(1, 12))->map(function ($m) {
            return Carbon::create()->month($m)->locale('fr')->monthName;
        });

        //  Graphique Avis
        $avisChart = new Chart;
        $avisChart->labels($mois);
        $avisChart->dataset('Avis', 'bar', $mois->map(fn($m, $i) => $avisParMois[$i+1] ?? 0))->backgroundColor('#3490dc');

        //  Graphique Délibérations
        $delibChart = new Chart;
        $delibChart->labels($mois);
        $delibChart->dataset('Délibérations', 'bar', $mois->map(fn($m, $i) => $delibParMois[$i+1] ?? 0))->backgroundColor('#38c172');

        $pdfsParType = Pdf::select('type', DB::raw('count(*) as total'))->groupBy('type')->pluck('total','type')->toArray();


        // Liste des années budgétaires disponibles
        $annees = AnneeBudgetaire::pluck('libelle', 'id');

        return view('dashboard', compact(
            'totalAvis',
            'totalDeliberations',
            'avisAnnee',
            'deliberationsAnnee',
            'annees',
            'annee',
            'avisChart', 'delibChart', 'totalReferences', 'president','pdfsParType'
        ));
    }
}

