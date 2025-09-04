<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceJuridique extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description'
    ];

    public function avis()
    {
        return $this->belongsToMany(Avis::class, 'avis_reference_juridique');
    }

    public function deliberations()
    {
        return $this->belongsToMany(Deliberation::class, 'deliberation_reference_juridique');
    }
}
