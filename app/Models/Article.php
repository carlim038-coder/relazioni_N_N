<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Campi che possono essere salvati tramite mass assignment
    protected $fillable = [
        'title',
        'subtitle',
        'body',
        'img',
        'user_id',
    ];

    /**
     * Relazione uno-a-molti inversa: un articolo appartiene a un utente (autore).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relazione molti-a-molti: un articolo può avere più tag.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}