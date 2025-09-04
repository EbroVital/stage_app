<?php

namespace App\Http\Controllers;

use App\Http\Requests\articleRequest;
use App\Models\Article;
use App\Models\Avis;
use App\Models\Deliberation;
use Illuminate\Http\Request;
use NumberFormatter;

function convertirMontantEnLettres($montant)
{
    $f = new \NumberFormatter("fr", \NumberFormatter::SPELLOUT);
    return ucfirst($f->format($montant));
}

class ArticleController extends Controller
{
    public function listeArticlesAvis(){
        // On récupère tous les articles liés aux avis
        $articles = Article::where('articleable_type', 'App\Models\Avis')->with('articleable')->get();
        $type = 'avis';
        return view('articles.index', compact('articles', 'type'));
    }

    public function listeArticlesDeliberation(){
        // On récupère tous les articles liés aux délibérations
        $articles = Article::where('articleable_type', 'App\Models\Deliberation')->with('articleable')->get();
        $type = 'deliberation';
        return view('articles.index', compact('articles', 'type'));
    }

    public function create(Request $request, $type, $id)
    {
        if ($type === 'avis') {
            $avis = Avis::with('anneeBudgetaire')->findOrFail($id);
            $montantAvis = convertirMontantEnLettres($avis->montant);
            return view('articles.create', compact('type', 'id', 'avis', 'montantAvis'));
        }
        elseif ($type === 'deliberation') {
            $deliberation = Deliberation::with('anneeBudgetaire')->findOrFail($id);
            $montant = convertirMontantEnLettres($deliberation->montant);
            return view('articles.create', compact('type', 'id', 'deliberation', 'montant'));
        }

        if (!in_array($type, ['avis', 'deliberation']) || !$id) {
            abort(404); // sécurité
        }
    }

    // public function store(articleRequest $request) {
    //     // $count = Article::where('articleable_type', $request->articleable_type)
    //     //                 ->where('articleable_id', $request->articleable_id)
    //     //                 ->count();

    //     foreach ($request->contenus as $index => $contenu) {
    //         Article::create([
    //             'numero' => $index + 1,
    //             'contenu' => $contenu,
    //             'articleable_id' => $request->id === 'avis' ? $request->parent_id : null,
    //             'articleable_type' => $request->type === 'deliberation' ? $request->parent_id : null,
    //         ]);
    //     }


    //     if ($request->type === 'avis') {
    //         return redirect()->route('articles.avis.index', ['avis' => $request->parent_id])->with('success', 'Articles ajoutés avec succès.');
    //     } else {
    //         return redirect()->route('articles.deliberation.index', ['deliberation' => $request->parent_id])->with('success', 'Articles ajoutés avec succès.');
    //     }
    // }

    public function store(articleRequest $request)
    {
        // dd($request->all());
        foreach ($request->contenus as $index => $contenu) {
            Article::create([
                'numero' => $index + 1,
                'contenu' => $contenu,
                'articleable_id' => $request->parent_id,
                'articleable_type' => $request->type === 'avis' ? Avis::class : Deliberation::class,
            ]);
        }

        if ($request->type === 'avis') {
            return redirect()->route('articles.avis.liste', ['avis' => $request->parent_id])->with('success', 'Articles ajoutés avec succès.');
        } else {
            return redirect()->route('articles.deliberations.liste', ['deliberation' => $request->parent_id])->with('success', 'Articles ajoutés avec succès.');
        }
    }


    public function edit($id)
    {
        $article = Article::findOrFail($id);
        // Déduire le type (avis ou délibération)
        $type = class_basename($article->articleable_type) === 'Avis' ? 'avis' : 'deliberation';
        return view('articles.edit', compact('article','type'));
    }

    // public function update(articleRequest $request, Article $article)
    // {
    //     $article->update([
    //         'contenu' => $request->contenu,
    //     ]);

    //     return redirect()->route('article.index')->with('success', 'Article modifié avec succès.');
    // }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update([
            'contenu' => $request->contenu,
        ]);

        // modification de l'avis/deliberation en fonction de l'id reçu
        $type = class_basename($article->articleable_type) === 'Avis' ? 'avis' : 'deliberation';
        $parentId = $article->articleable_id;

        if ($type === 'avis') {
            return redirect()->route('articles.avis.liste', ['avis' => $parentId])->with('success', 'Article modifié avec succès.');
        } else {
            return redirect()->route('articles.deliberations.liste', ['deliberation' => $parentId])->with('success', 'Article modifié avec succès.');
        }
    }

    // public function destroy(Article $article)
    // {
    //     $article->delete();
    //     return redirect()->route('article.index')->with('success', 'Article supprimé avec succès.');
    // }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        //suppression de l'avis/deliberation en fonction de l'id reçu
        $type = class_basename($article->articleable_type) === 'Avis' ? 'avis' : 'deliberation';
        $parentId = $article->articleable_id;

        $article->delete();

        if ($type === 'avis') {
            return redirect()->route('articles.avis.liste', ['avis' => $parentId])->with('success', 'Article supprimé avec succès.');
        } else {
            return redirect()->route('articles.deliberation.liste', ['deliberation' => $parentId])->with('success', 'Article supprimé avec succès.');
        }
    }



}
