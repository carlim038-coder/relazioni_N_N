<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Modifica Articolo: {{ $article->title }}</h1>

                {{-- Mostra eventuali errori di validazione --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form di Modifica --}}
                <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Titolo --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title) }}" required>
                    </div>

                    {{-- Sottotitolo --}}
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Sottotitolo</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle', $article->subtitle) }}">
                    </div>

                    {{-- Immagine attuale e nuovo caricamento --}}
                    <div class="mb-3">
                        <label class="form-label">Immagine Attuale</label>
                        @if ($article->img)
                            <div class="mb-2">
                                <img src="{{ Storage::url($article->img) }}" alt="{{ $article->title }}" width="150" class="img-thumbnail">
                            </div>
                        @else
                            <p class="text-muted">Nessuna immagine caricata</p>
                        @endif

                        <label for="img" class="form-label">Carica nuova immagine (opzionale)</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>

                    {{-- Corpo dell'articolo --}}
                    <div class="mb-3">
                        <label for="body" class="form-label">Corpo del testo</label>
                        <textarea class="form-control" id="body" name="body" rows="6" required>{{ old('body', $article->body) }}</textarea>
                    </div>

                    {{-- Sezione Categorie (molti-a-molti) --}}
                    <div class="mb-3">
                        <label class="form-label">Modifica Categorie</label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-edit-{{ $category->id }}"
                                        {{-- Mantiene lo stato selezionato sia in caso di errore di validazione (old) sia se la categoria è associata all'articolo --}}
                                        @if((is_array(old('categories')) && in_array($category->id, old('categories'))) || (!old('categories') && $article->categories->contains($category))) checked @endif>
                                    
                                    <label class="form-check-label" for="category-edit-{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sezione Tag (molti-a-molti) --}}
                    <div class="mb-3">
                        <label class="form-label">Modifica Tag</label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-edit-{{ $tag->id }}"
                                        {{-- Mantiene lo stato selezionato sia in caso di errore di validazione (old) sia se il tag è associato all'articolo --}}
                                        @if((is_array(old('tags')) && in_array($tag->id, old('tags'))) || (!old('tags') && $article->tags->contains($tag))) checked @endif>
                                    
                                    <label class="form-check-label" for="tag-edit-{{ $tag->id }}">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Pulsanti di azione --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Indietro</a>
                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>