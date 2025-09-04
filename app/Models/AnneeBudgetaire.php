<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeBudgetaire extends Model
{
    use HasFactory;

    protected $fillable = ['libelle'];
 
    public function avis(){
        return $this->hasMany(Avis::class);
    }

    public function deliberations(){
        return $this->hasMany(Deliberation::class);
    }

    public static function getOrCreateCurrentYear()
    {
        $year = date('Y');

        return self::firstOrCreate(['libelle' => $year]);
    }

}
