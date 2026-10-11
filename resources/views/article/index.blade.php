<x-layout>
    
    <!-- Componente Masthead -->
    <x-masthead />

    <div class="container my-5">
        
        <!-- Sezione Titolo della pagina -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold display-6">Tutte le Guide di Viaggio</h2>
                <p class="text-secondary">Scopri i consigli dei viaggiatori per esplorare il mondo spendendo poco</p>
            </div>
        </div>

        <!-- Bottoni per filtrare i tag -->
<div class="row mb-5">
    <div class="col-12 text-center">
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <span class="fw-bold align-self-center me-2 text-muted">Esplora per tag:</span>
            @foreach(\App\Models\Tag::all() as $tag)
                <a href="{{ route('articles.tag', $tag) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm">
                    <i class="bi bi-tag-fill me-1"></i> {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>

        <!-- Messaggio di successo -->
        @if (session('success'))
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Griglia degli Articoli -->
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-md-4">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-white rounded shadow-sm">
                        <i class="bi bi-journal-x display-1 text-muted mb-3"></i>
                        <h3 class="text-secondary">Nessuna guida pubblicata al momento</h3>
                        <p class="text-muted mb-4">Sii il primo a condividere la tua esperienza di viaggio low cost!</p>
                        <a href="{{ route('articles.create') }}" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-plus-circle"></i> Pubblica la prima guida
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

    </div>

</x-layout>