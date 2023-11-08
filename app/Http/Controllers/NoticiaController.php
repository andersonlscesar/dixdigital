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
        $news = Noticia::with('user')->get();
        return view('noticias.index', compact('news'));
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
    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAndUpdateRequest $request, Noticia $noticia)
    {
        dd($noticia);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        try {
            $noticia->delete();
            return redirect()->route('noticias.index')->with('status', 'Notícia excluída com sucesso.');
        } catch (\Exception $error ) {
            Log::error('Erro ao excluir notícia ' . $error->getMessage());
            return redirect()->route('noticias.show', $noticia->id)->with('error', 'Erro ao excluir notícia.');
        }
    }
}
