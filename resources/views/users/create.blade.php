@extends('layouts.app', ['page' => __('Users'), 'pageSlug' => 'users'])

@section('content')

    <div class="card mb-3 p-2">

        @include('alerts.success')

        <div class="card-header">
            <h5 class="title">Cadastro de usuários</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                @method("POST")
                @include('users._form')
            </form>
        </div>

    </div>

@endsection