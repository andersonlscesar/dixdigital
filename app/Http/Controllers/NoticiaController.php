<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAndUpdateRequest;
use App\Models\Noticia;
use Illuminate\Support\Facades\Log;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('noticias.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAndUpdateRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            Noticia::create( $data );
            return redirect()->route('noticias.create')->with('status', 'Notícia publicada com sucesso.');
        } catch (\Throwable $error ) {
            Log::error('Erro ao publicar a notícia ' . $error );
            return redirect()->route('noticias.create')->with('error', 'Erro ao publicar a notícia.');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
