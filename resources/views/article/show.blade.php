<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Titolo e Sottotitolo -->
                <h1 class="fw-bold display-5 mb-2">{{ $article->title }}</h1>
                <h3 class="text-muted fs-4 mb-3">{{ $article->subtitle }}</h3>
                
                <!-- Informazioni su Autore e Data -->
                <div class="d-flex align-items-center mb-3 pb-3 border-bottom text-secondary">
                    <span>Scritto da <strong class="text-dark">{{ $article->user->name ?? 'Anonimo' }}</strong></span>
                    <span class="mx-2">•</span>
                    <span>Pubblicato il {{ $article->created_at->format('d/m/Y') }}</span>
                </div>

                <!-- Pulsanti di Gestione CRUD (Stile Aulab) -->
                <div class="d-flex align-items-center gap-2 mb-4">
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning text-dark px-3 py-1">
                        <i class="bi bi-pencil-square"></i> Modifica
                    </a>

                    <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo articolo?');" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-3 py-1">
                            <i class="bi bi-trash"></i> Elimina
                        </button>
                    </form>
                </div>

                <!-- Tag / Categorie associate -->
                @if($article->tags->count() > 0)
                    <div class="mb-4">
                        @foreach($article->tags as $tag)
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 me-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif

                <!-- Immagine di copertina -->
                <div class="mb-5">
                    @if($article->img)
                        <img src="{{ Storage::url($article->img) }}" class="img-fluid rounded shadow-sm w-100" alt="{{ $article->title }}" style="max-height: 450px; object-fit: cover;">
                    @else
                        <img src="https://picsum.photos/800/400" class="img-fluid rounded shadow-sm w-100" alt="Immagine di default" style="max-height: 450px; object-fit: cover;">
                    @endif
                </div>

                <!-- Corpo dell'articolo -->
                <div class="article-body fs-5 lh-lg text-secondary mb-5">
                    {!! nl2br(e($article->body)) !!}
                </div>

                <!-- Pulsante per tornare indietro -->
                <div class="text-start">
                    <a href="{{ route('articles.index') }}" class="btn btn-dark px-4 py-2">
                        ← Torna a tutte le guide
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layout>