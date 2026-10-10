<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Mostra la lista degli articoli.
     */
    public function index()
    {
        $articles = Article::all();
        return view('article.index', compact('articles'));
    }

    /**
     * Mostra il form per creare un nuovo articolo.
     */
    public function create()
    {
        $tags = Tag::all(); 
        return view('article.create', compact('tags'));
    }

    /**
     * Salva un nuovo articolo nel database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'body' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $data = $request->all();

        // Gestione dell'immagine se presente
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('images', 'public');
        }

        // Assegniamo l'utente loggato, oppure 1 di default
        $data['user_id'] = Auth::id() ?? 1;

        // Creazione dell'articolo
        $article = Article::create($data);

        // Gestione Tag (Many-to-Many)
        if ($request->has('tags')) {
            $article->tags()->attach($request->tags);
        }

        return redirect()->route('articles.index')->with('success', 'Articolo creato con successo!');
    }

    /**
     * Mostra il dettaglio di un singolo articolo.
     */
    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    /**
     * Mostra il form per modificare un articolo esistente.
     */
    public function edit(Article $article)
    {
        $tags = Tag::all();
        return view('article.edit', compact('article', 'tags'));
    }

    /**
     * Aggiorna l'articolo nel database.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'body' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $data = $request->all();

        // Gestione eventuale nuova immagine
        if ($request->hasFile('img')) {
            if ($article->img) {
                Storage::disk('public')->delete($article->img);
            }
            $data['img'] = $request->file('img')->store('images', 'public');
        }

        $article->update($data);

        // Sincronizzazione Tag
        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        } else {
            $article->tags()->sync([]);
        }

        return redirect()->route('articles.index')->with('success', 'Articolo modificato con successo!');
    }

    /**
     * Mostra gli articoli filtrati per tag (che fanno da categoria).
     */
    public function category(Tag $tag)
    {
        $articles = $tag->articles;
        $category = $tag; // Adatta il tag alla variabile $category richiesta dalla vista
        return view('article.category', compact('category', 'articles'));
    }

    /**
     * Elimina l'articolo dal database.
     */
    public function destroy(Article $article)
    {
        if ($article->img) {
            Storage::disk('public')->delete($article->img);
        }

        $article->tags()->detach();
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Articolo eliminato con successo!');
    }
}