<x-layout>
    <div class="container my-5">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1>Guide per la categoria: <span class="text-primary">{{ $category->name }}</span></h1>
                <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary btn-sm mt-2">Tutte le guide</a>
            </div>

            @forelse ($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($article->img)
                            <img src="{{ Storage::url($article->img) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $article->title }}</h5>
                            <p class="card-text text-muted">{{ $article->subtitle }}</p>
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-dark mt-auto">Leggi la guida</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Non ci sono ancora guide pubblicate per questa categoria.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>