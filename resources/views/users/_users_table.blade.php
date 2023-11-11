<div class="card">
    <div class="card-body">
        <table class="table table-striped">

            <thead>
                <th>Nº</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Perfil</th>
                <th>Data de criação</th>
                <th>Ações</th>
            </thead>

            <tbody>

                @foreach($users as $key => $user)

                    <tr>
                        <td>{{ $key + 1  }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        @foreach($user->permissions as $permission)
                            <td>{{ ucfirst( $permission->name ) }}</td>
                        @endforeach

                        <td>{{ dateToString( $user->created_at ) }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}"><button class="btn btn-info">Editar</button></a>
                            <a href="{{ route('user.confirmation', $user->id) }}"><button class="btn btn-danger">Deletar</button></a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</div>
