<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_avis',
        'objet',
        'entendu',
        'heure_debut',
        'heure_fin',
        'montant',
        'beneficiaire',
        'annee_budgetaire_id'
    ];


    public function articles()
    {
        return $this->morphMany(Article::class, 'articleable');
    }

    protected static function booted()
    {
        static::deleting(function ($avis) {
            $avis->articles()->delete();
        });
    }


    public function signataires(){
        return $this->belongsToMany(Signataire::class, 'avis_signataire')
                ->withPivot('fonction', 'ordre')
                ->withTimestamps();
    }

    public function referencesJuridiques()
    {
        return $this->belongsToMany(ReferenceJuridique::class, 'avis_reference_juridique');
    }

    public function anneeBudgetaire(){
        return $this->belongsTo(AnneeBudgetaire::class);
    }


}
