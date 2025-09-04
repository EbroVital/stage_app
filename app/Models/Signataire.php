<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signataire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'qualite',
    ];

    public function avis()
    {
        return $this->belongsToMany(Avis::class, 'avis_signataire')
                    ->withPivot('fonction', 'ordre')
                    ->withTimestamps();
    }

    public function deliberations()
    {
        return $this->belongsToMany(Deliberation::class, 'deliberation_signataire')
                    ->withPivot('fonction', 'ordre')
                    ->withTimestamps();
    }
}
