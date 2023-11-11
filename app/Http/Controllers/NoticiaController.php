<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAndUpdateRequest;
use App\Models\Noticia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('pesquisa');
        $news = Noticia::with('user')->when(!empty($search),  function( $q ) use ($search) {
            $q->where('title', 'LIKE', "%$search%")
                ->orWhere('content', 'LIKE', "%$search%");
        })->where('user_id', auth()->user()->id )->orderBy('id', 'desc')->get();
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
            $data = $request->all();
            $data['user_id'] = auth()->user()->id;

            if ( $request->hasFile( 'image' ) && $request->file( 'image' )->isValid() ) {
                $data['image'] = $request->image->store('noticias');
            }

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
        try {
            $data = $request->validated();
            $noticia->update( $data );
            return redirect()->route('noticias.edit', $noticia->id)->with('status', 'Notícia editada com sucesso.');
        } catch (\Exception $error ) {
            Log::error('Erro ao editar notícia. ' . $error->getMessage() );
            return redirect()->route('noticias.edit', $noticia->id)->with('error', 'Erro ao editar notícia.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        try {
            if ( !is_null( $noticia->image ) ) {
                $this->deleteImage( $noticia->image );
            }
            $noticia->delete();
            return redirect()->route('noticias.index')->with('status', 'Notícia excluída com sucesso.');
        } catch (\Exception $error ) {
            Log::error('Erro ao excluir notícia ' . $error->getMessage());
            return redirect()->route('noticias.show', $noticia->id)->with('error', 'Erro ao excluir notícia.');
        }
    }


    private function deleteImage( $filename )
    {
        if (Storage::disk('public')->exists($filename)) {
            Storage::disk('public')->delete($filename);
        }
    }
}
