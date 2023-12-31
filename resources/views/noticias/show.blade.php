@extends('layouts.app', ['page' => __('Noticias'), 'pageSlug' => 'noticia'])

@section('content')
    <a href="{{ url()->previous() }}"><button class="btn btn-secondary mb-4">Voltar</button></a>
    <div class="card mb-3 p-3">

        @include('alerts.success')

        <div class="card-header">
            <div class="d-flex gap-2">
                @if ($noticia->user->profile_image)
                    <img style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; " src="{{ url('storage/' . $noticia->user->profile_image) }}" alt="{{ $noticia->user->name }}">
                @endif
                <div class="d-flex flex-column ml-3">
                    <h4 class="title">{{ ucfirst( $noticia->title ) }}</h4>
                    <small>{{ dateToString( $noticia->created_at ) }}</small>
                    <small>{{ countTimeForHumans( $noticia->created_at ) }}</small>
                    <small>Autor: {{ $noticia->user->name }}</small>
                </div>
            </div>

        </div>
    </div>


    <div class="card" >
        <div class="card-body" >
            @if (!is_null($noticia->image))
                <img class="rounded img-fluid float-left mb-4 mr-4" src="{{ url("storage/{$noticia->image}") }}" alt="{{ $noticia->titulo }}">
            @endif
            <div>{{ ucfirst($noticia->content) }}</div>
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('noticias.edit', $noticia->id) }}"><button class="btn btn-primary">Editar</button></a>

        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm_modal">Deletar</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirm_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title fs-5" id="exampleModalLabel">Confirmar exclusão</h4>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja deletar a publicação? </p>
                    <p><strong><i>"{{ $noticia->title }}"</i></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
