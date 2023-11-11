<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());
        return back()->withStatus(__('Perfil atualizado com sucesso.'));
    }

    public function setImage(Request $request)
    {
        try {
            $request->validate([
                'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
            ], [
                'image.image' => 'Apenas imagens são permitidas',
                'image.mimes' => 'Formato de arquivo inválido',
                'image.max'   => 'Tamanho máximo para enviar a imagem :max kilobytes.'
            ]);

            if ($request->hasFile('image')) {

                if (!is_null(auth()->user()->profile_image) && Storage::disk('public')->exists( auth()->user()->profile_image ) ) {
                    Storage::disk('public')->delete( auth()->user()->profile_image );
                }

                $path = $request->image->store('profile');
                $user = auth()->user();
                $user->profile_image = $path;
                $user->save();
                return redirect()->route('profile.edit')->with('status', 'Foto de perfil definida com sucesso.');
            }

            return redirect()->route('profile.edit')->with('error', 'Erro ao definir foto de perfil.');
        } catch (\Exception $error) {
            Log::error('Erro ao definir foto de perfil ' . $error->getMessage());
            return redirect()->route('profile.edit')->with('error', 'Erro ao definir foto de perfil.');
        }
    }
    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Senha atualizada com sucesso.'));
    }
}
