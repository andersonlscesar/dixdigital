<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Fluent\Concerns\Has;

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
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make( $data['password'] );
            User::create( $data );
            return redirect()->route('user.create')->with('status', 'Usuário cadastrado com sucesso.');
        } catch (\Exception $error ) {
            Log::error('Erro ao cadastrar novo usuário. ' . $error->getMessage() );
            return redirect()->route('user.create')->with('error', 'Erro ao cadastrar novo usuário.');
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $user->update( $data );
            return redirect()->route('user.edit', $user->id)->with('status', 'Cadastro atualizado com sucesso.');
        } catch (\Throwable $error ) {
            Log::error('Não foi possível atualizar este cadastro. ' . $error->getMessage() );
            return redirect()->route('user.edit', $user->id)->with('error', 'Não foi possível atualizar este cadastro.');
        }
    }

    public function password(Request $request, User $user)
    {
        dd($request);
    }
}
