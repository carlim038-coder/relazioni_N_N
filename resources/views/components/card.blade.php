@props(['article'])

<div class="card h-100 shadow-sm border-0">
    @if($article->img)
        <img src="{{ Storage::url($article->img) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
    @else
        <img src="https://picsum.photos/600/400" class="card-img-top" alt="Immagine di default" style="height: 200px; object-fit: cover;">
    @endif
    
    <div class="card-body d-flex flex-column">
        <h5 class="card-title fw-bold">{{ $article->title }}</h5>
        <p class="card-text text-muted small">{{ $article->subtitle }}</p>
        
        <!-- Autore -->
        <p class="card-text mt-auto mb-2">
            <small class="text-secondary">Scritto da: <strong>{{ $article->user->name ?? 'Viaggiatore' }}</strong></small>
        </p>

        <!-- Tag associati -->
        <div class="mb-3">
            @foreach($article->tags as $tag)
                <span class="badge bg-secondary me-1">#{{ $tag->name }}</span>
            @endforeach
        </div>
        
        <a href="{{ route('articles.show', $article) }}" class="btn btn-outline-primary w-100">Leggi la guida</a>
    </div>
</div>