<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PreventDeleteYourself
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currUserPermissions = Auth::user()->with('permissions')->get();
        $idUserAboutBeDeleted = $request->route('user')->id;

        if ( !is_null( $idUserAboutBeDeleted ) ) {

            foreach ( $currUserPermissions as $userPermission ) {

                if ( $userPermission->hasPermissionTo( 'administrador' ) && Auth::user()->id === $idUserAboutBeDeleted ) {
                    abort(403, 'Permissão negada. Você não pode deletar a própria conta');
                }

            }

        }

        return $next($request);
    }
}
