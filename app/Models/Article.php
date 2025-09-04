<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'contenu', 'articleable_id', 'articleable_type'];


    public function articleable()
    {
        return $this->morphTo();
    }


}
