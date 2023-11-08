@if (session($key ?? 'status'))
    <div class="alert alert-success" role="alert">
        {{ session($key ?? 'status') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
