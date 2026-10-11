<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4 fw-bold">Crea una nuova Guida</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm border-0">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo della meta</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Sottotitolo / Descrizione breve</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Racconto del viaggio e consigli</label>
                        <textarea class="form-control" id="body" name="body" rows="6" required>{{ old('body') }}</textarea>
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label">Scegli i Tag</label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}"
                                        @if(is_array(old('tags')) && in_array($tag->id, old('tags'))) checked @endif>
                                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="img" class="form-label">Immagine di copertina</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>

                    <button type="submit" class="btn btn-dark w-100 py-2">Pubblica Guida</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>