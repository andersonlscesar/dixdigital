<div class="form-group @error('title') has-danger @enderror">
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Título da notícia" name="title" value="{{ $noticia->title ?? old('title') }}">
    @include('alerts.feedback', ['field' => 'title'])
</div>

<div class="form-group @error('content') has-danger @enderror">
    <textarea rows="10" class="form-control @error('content') is-invalid @enderror" name="content" id="content" placeholder="Conteúdo da notícia">{{ $noticia->content ?? old('content') }}</textarea>
    @include('alerts.feedback', ['field' => 'content'])
</div>
<button type="submit" class="btn btn-primary">{{ request()->route()->getName() === 'noticias.edit' ? 'Editar' : 'Publicar' }}</button>
