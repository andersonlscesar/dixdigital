@extends('layouts.app', ['page' => __('Users'), 'pageSlug' => 'users'])

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="title">Confirmar exclusão</h5>
        </div>
        <div class="card-body">
            <p>Tem certeza que deseja excluir o(a) usuário(a) <strong>{{ $user->name }}</strong> ?</p>
            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-danger">Confirmar</button>
                <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Cancelar</button></a>
            </form>
        </div>
    </div>
@endsection
