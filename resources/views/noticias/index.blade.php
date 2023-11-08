@extends('layouts.app', ['page' => __('Noticias'), 'pageSlug' => 'noticias'])

@section('content')
    <div class="card mb-3 p-3">

        @include('alerts.success')

        <div class="card-header text-dark">
            <h4 class="title">Minhas Notícias</h4>
        </div>
    </div>

    @forelse($news as $new)
        @include('noticias._news_cards')
    @empty
        <div class="card p-3">
            <div class="card-header">
                <h5>Ainda não há notícias publicadas.</h5>
            </div>
        </div>
    @endforelse

@endsection
