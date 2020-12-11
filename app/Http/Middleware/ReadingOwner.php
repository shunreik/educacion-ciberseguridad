<?php

namespace App\Http\Middleware;

use App\Models\Reading;
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
        $readingId = is_numeric($request->route('reading')) ?
            Reading::findOrFail($request->route('reading'))->user_id  :
            $request->route('reading')->user_id; //se obtiene el id del propietario de la lectura de la ruta

        if ($userId !== $readingId) {
            return abort(403, 'Acción no autorizada');
        }
        return $next($request);
    }
}
