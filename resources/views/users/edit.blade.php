@extends('layouts.app', ['page' => __('Users'), 'pageSlug' => 'users'])

@section('content')
    <a href="{{ route('user.index') }}"><button class="btn btn-secondary">Voltar</button></a>
    <div class="card mt-3 p-2">
        @include('alerts.success')
        <div class="card-header">
            <h5 class="title">Editar cadastro</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="form-group @error('name') has-danger @enderror">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nome" name="name" value="{{ $user->name }}">
                    @include('alerts.feedback', ['field' => 'name'])
                </div>

                <div class="form-group @error('email') has-danger @enderror">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="E-mail" name="email" value="{{  $user->email }}">
                    @include('alerts.feedback', ['field' => 'email'])
                </div>

                <div class="form-group @error('nivel') has-danger @enderror">
                    <select class="form-select form-control @error('nivel') is-invalid @enderror" aria-label="Seleção de nível de acesso" name="nivel">
                        <option value="">Selecione um nível de acesso</option>
                        {{-- Listando as permissões --}}
                        @foreach($permissions as $permission)
                            @foreach($user->permissions as $p)
                                <option value="{{ $permission->id }}" {{ $permission->id === $p->id ? 'selected' : '' }}>{{ ucfirst($permission->name) }}</option>
                            @endforeach
                        @endforeach
                    </select>
                    @include('alerts.feedback', ['field' => 'nivel'])
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>


    <div class="card mt-2 p-2">
        <div class="card-header">
            <h5 class="title">Redefinir senha</h5>
        </div>

        <div class="card-body">

            {{-- formulário para redefinição de senha--}}
            <form action="{{ route('user.password', $user->id) }}" method="POST" >
                @csrf
                @method("PUT")
                <div class="form-group @error('password') has-danger @enderror">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Nova senha" name="password">
                    @include('alerts.feedback', ['field' => 'password'])
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" id="password_confirmation" placeholder="Confirmar senha" name="password_confirmation">
                </div>
                <input type="hidden" name="reset_password" value="true">
                <button type="submit" class="btn btn-primary">Redefinir</button>
            </form>

        </div>
    </div>


@endsection
