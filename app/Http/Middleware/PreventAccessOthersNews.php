<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PreventAccessOthersNews
{
    /**
     * Este middleware previne que os usuários possam interferir nas notícias dos outros.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $noticia = $request->route('noticia');
        if ($noticia->user_id !== Auth::user()->id ) abort(403, 'Acesso negado');
        return $next($request);
    }
}
