<div class="form-group @error('title') has-danger @enderror">
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Título da notícia" name="title" value="{{ $noticia->title ?? old('title') }}">
    @include('alerts.feedback', ['field' => 'title'])
</div>

<div class="form-group">
    <label for="image" class="btn btn-outline-info my-3 " style="cursor: pointer;">Selecione uma imagem</label>
    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" style="display: none">
    @include('alerts.feedback', ['field' => 'image'])
</div>

<img src="{{ isset($noticia) ? url("storage/{$noticia->image}") : ""  }}" alt="preview" id="previewImage" class="img-thumbnail" style="max-width: 600px; object-fit: contain;">

<div class="form-group @error('content') has-danger @enderror">
    <textarea rows="10" class="form-control @error('content') is-invalid @enderror" name="content" id="content" placeholder="Conteúdo da notícia">{{ $noticia->content ?? old('content') }}</textarea>
    @include('alerts.feedback', ['field' => 'content'])
</div>
<button type="submit" class="btn btn-primary">{{ request()->route()->getName() === 'noticias.edit' ? 'Editar' : 'Publicar' }}</button>
