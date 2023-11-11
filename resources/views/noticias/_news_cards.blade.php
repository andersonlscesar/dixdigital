<a href="{{ route('noticias.show', $new->id) }}" title="Clique aqui para ler mais">
    <div class="card mb-2">

        <div class="card-header">
            <h5 class="title">{{ ucfirst( $new->title ) }}</h5>
            <small>{{ dateToString( $new->created_at ) }}</small>
            <small>{{ countTimeForHumans( $new->created_at ) }}</small>
            <br>

        </div>

        <div class="card-body">
            {{ mb_strcut( ucfirst( $new->content ), 0, rand(300, 500 ) )  }} ...
        </div>

        <div class="card-footer">
            <small>Autor: {{ ucwords( $new->user->name )  }}</small>
        </div>

    </div>
</a>
