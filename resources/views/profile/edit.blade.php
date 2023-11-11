@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('messages.edit_profile') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('messages.name') }}" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('messages.email') }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                            {{-- Cargo / Função--}}

                            <div class="form-group">
                                <input type="text" name="role" class="form-control" placeholder="{{ __('Cargo / Função (Opcional)') }}" value="{{ old('role', auth()->user()->role ?? "") }}">
                            </div>

                            {{-- Descrição--}}

                            <div class="form-group">
                                <textarea class="form-control" placeholder="{{ __('Autodescrição (Opcional)') }}" name="description">{{ auth()->user()->description ?? "" }}</textarea>
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('messages.save') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('messages.password') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('messages.curr_pwd') }}" value="" >
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('messages.new_pwd') }}" value="" >
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>

                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('messages.confirm_new_pwd') }}" value="" >
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('messages.change_pwd') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <form action="{{ route('profile.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <label for="image" style="cursor: pointer;" title="Clique aqui para alterar a foto de perfil">
                                    <img class="avatar" id="previewImage" src="{{ auth()->user()->profile_image ? url("storage/" . auth()->user()->profile_image) :  asset('img/profile.png') }}" alt="profile" style="object-fit: cover;">
                                    <h5 class="title">{{ ucwords(auth()->user()->name) }}</h5>
                                </label>
                                <input type="file" id="image" name="image" style="display: none">
                                <br>
                                <button class="btn btn-primary mb-3">Salvar</button>
                            </form>
                            <p class="description">
                                {{ auth()->user()->role ?? "" }}
                            </p>
                        </div>

                    <div class="card-description text-center">
                        {{ auth()->user()->description ?? "" }}
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
@endsection
