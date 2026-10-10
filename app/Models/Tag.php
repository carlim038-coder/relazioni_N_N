<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Campi assegnabili in massa
    protected $fillable = [
        'name',
    ];

    /**
     * Relazione molti-a-molti inversa: un tag può essere associato a più articoli.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}