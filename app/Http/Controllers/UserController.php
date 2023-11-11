<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = $model->with('permissions')->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Exibe o formulário para cadastro de novos usuários
    */

    public function create()
    {
        $permissions = Permission::all();
        return view('users.create', compact('permissions'));
    }

    /**
     * Insere um novo registro no BD
     * @param UserRequest $request
    */

    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make( $data['password'] );
            $user = User::create( $data );
            $permission = Permission::findById( $data['nivel'] ?? 1);
            $user->givePermissionTo( $permission->name );
            return redirect()->route('user.create')->with('status', 'Usuário cadastrado com sucesso.');
        } catch (\Exception $error ) {
            Log::error('Erro ao cadastrar novo usuário. ' . $error->getMessage() );
            return redirect()->route('user.create')->with('error', 'Erro ao cadastrar novo usuário.');
        }
    }

    /**
     * Exibe o formulário de edição de registro
     * @param User $user
    */

    public function edit(User $user)
    {
        $user->load('permissions');
        $permissions = Permission::all();
        return view('users.edit', compact('user', 'permissions'));
    }

    /**
     * Atualiza um registro
     * @param UserRequest $request
     * @param User $user
    */

    public function update(UserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $newPermission = Permission::findById( $data['nivel'] );
            $user->update( $data );
            $user->syncPermissions( [$newPermission] );
            return redirect()->route('user.edit', $user->id)->with('status', 'Cadastro atualizado com sucesso.');
        } catch (\Throwable $error ) {
            Log::error('Não foi possível atualizar este cadastro. ' . $error->getMessage() );
            return redirect()->route('user.edit', $user->id)->with('error', 'Não foi possível atualizar este cadastro.');
        }
    }

    /**
     * Redefine a senha do usuário
     * @param UserRequest $request
     * @param User $user
    */

    public function password(UserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $user->update( $data );
            return redirect()->route('user.edit', $user->id)->with('status', 'Senha redefinida com sucesso.');
        } catch (\Exception $error ) {
            Log::error('Erro ao redefinir senha. ' . $error->getMessage() );
            return redirect()->route('user.edit', $user->id)->with('error', 'Erro ao redefinir a senha.');
        }
    }

    /**
     * Exibe a página de confirmação de exclusão de conta
     * @param User $user
    */

    public function confirmation(User $user)
    {
        return view('users.confirm', compact('user'));
    }

    /**
     * Função responsável por deletar a conta
     * @param User $user
    */

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.index')->with('status', 'Conta deletada com sucesso.');
        } catch (\Exception $error ) {
            Log::error('Erro ao excluir esta conta. ' . $error->getMessage() );
            return redirect()->route('user.index')->with('error', 'Erro ao excluir esta conta.');
        }
    }
}
