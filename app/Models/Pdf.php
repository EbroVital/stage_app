<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'filename',
        'path',
        'user_id',
    ];

    // Relation avec User (si nécessaire)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
