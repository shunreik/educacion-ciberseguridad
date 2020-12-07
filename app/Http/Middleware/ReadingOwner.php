<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ReadingOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->user()->id; //se obtiene el id del usuario que está realizando la petición
        $readingId = $request->route('reading')->user_id; //se obtiene el id del propietario de la lectura de la ruta

        if ($userId !== $readingId) {
            return abort(403, 'Acción no autorizada');
        }
        return $next($request);
    }
}
