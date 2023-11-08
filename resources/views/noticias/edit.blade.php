@extends('layouts.app', ['page' => __('Noticias'), 'pageSlug' => 'noticias'])

@section('content')
    <div class="card mb-3 p-2">

        @include('alerts.success')

        <div class="card-header text-dark">
            <h5 class="title">Editar notícia</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('noticias.update', $noticia->id) }}" method="POST" >
                @csrf
                @method("PUT")
                @include('noticias._form')
            </form>
        </div>
    </div>
@endsection
