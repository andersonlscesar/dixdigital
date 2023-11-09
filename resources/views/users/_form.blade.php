<div class="form-group @error('name') has-danger @enderror">
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nome" name="name" value="{{ old('name') }}">
    @include('alerts.feedback', ['field' => 'name'])
</div>

<div class="form-group @error('email') has-danger @enderror">
    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="E-mail" name="email" value="{{  old('email') }}">
    @include('alerts.feedback', ['field' => 'email'])
</div>

<div class="form-group @error('password') has-danger @enderror">
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Senha" name="password">
    @include('alerts.feedback', ['field' => 'password'])
</div>

<div class="form-group">
    <input type="password" class="form-control" id="password_confirmation" placeholder="Confirmar senha" name="password_confirmation">
</div>
<button type="submit" class="btn btn-primary">Cadastrar</button>
