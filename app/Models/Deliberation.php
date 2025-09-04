<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliberation extends Model
{
    use HasFactory;

    protected $fillable = [
        'objet',
        'annee_budgetaire_id',
        'numero',
        'entendu',
        'heure_debut',
        'heure_fin',
        'date_proposition',
        'date_convocation',
        'montant'
    ];

    public function anneeBudgetaire(){
        return $this->belongsTo(AnneeBudgetaire::class);
    }

    public function articles()
    {
        return $this->morphMany(Article::class, 'articleable');
    }

    protected static function booted()
    {
        static::deleting(function ($deliberation) {
            $deliberation->articles()->delete();
        });
    }


    public function signataires(){
        return $this->belongsToMany(Signataire::class, 'deliberation_signataire')
                ->withPivot('fonction', 'ordre')
                ->withTimestamps();
    }

    public function referencesJuridiques()
    {
        return $this->belongsToMany(ReferenceJuridique::class, 'deliberation_reference_juridique');
    }

}
