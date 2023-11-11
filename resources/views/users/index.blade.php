@extends('layouts.app', ['page' => __('Users'), 'pageSlug' => 'users'])

@section('content')

    <div class="card mb-3 p-2">
        @include('alerts.success')
        <div class="card-header">
            <h5 class="title">Lista de usuários</h5>
        </div>
    </div>

    @include('users._users_table')

@endsection
