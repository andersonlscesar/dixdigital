<div class="form-group @error('title') has-danger @enderror">
    <label for="title">Título da notícia</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Título da notícia" name="title" value="{{ old('title') }}">
    @include('alerts.feedback', ['field' => 'title'])
</div>

<div class="form-group @error('content') has-danger @enderror">
    <label for="content">Conteúdo da notícia</label>
    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" placeholder="Conteúdo da notícia">{{ old('content') }}</textarea>
    @include('alerts.feedback', ['field' => 'content'])
</div>
<button type="submit" class="btn btn-primary">{{ request()->route()->getName() === 'noticias.edit' ? 'Editar' : 'Publicar' }}</button>
