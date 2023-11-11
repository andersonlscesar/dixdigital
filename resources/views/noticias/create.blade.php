@extends('layouts.app', ['page' => __('Noticias'), 'pageSlug' => 'noticias_create'])

@section('content')
    <div class="card mb-3 p-2">


        @include('alerts.success')


        <div class="card-header text-dark">
            <h5 class="title">Publicar notícia</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")
                @include('noticias._form')
            </form>
        </div>
    </div>
@endsection
