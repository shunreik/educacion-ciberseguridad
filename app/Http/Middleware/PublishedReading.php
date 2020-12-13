<?php

namespace App\Http\Middleware;

use App\Models\Reading;
use Closure;
use Illuminate\Http\Request;

class PublishedReading
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
        $readingIsOn = is_numeric($request->route('reading')) ?
            Reading::findOrFail($request->route('reading'))->status :
            $request->route('reading')->status;
        
        if(!$readingIsOn){
            return abort(403, 'Acción no autorizada');
        }
        
        return $next($request);
    }
}
