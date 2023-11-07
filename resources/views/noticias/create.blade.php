@extends('layouts.app', ['page' => __('Noticias'), 'pageSlug' => 'noticias'])

@section('content')
    <div class="card mb-3">
        <div class="card-header text-dark">
            <h5 class="title">Publicar notícia</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                @csrf
                @method("POST")
                @include('noticias._form')
            </form>
        </div>
    </div>
@endsection
