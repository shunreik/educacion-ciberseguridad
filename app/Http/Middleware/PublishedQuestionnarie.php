<?php

namespace App\Http\Middleware;

use App\Models\Questionnarie;
use Closure;
use Illuminate\Http\Request;

class PublishedQuestionnarie
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
        $questionnarie = is_numeric($request->route('questionnarie')) ?
            Questionnarie::findOrFail($request->route('questionnarie')) :
            $request->route('questionnarie');

        $questionnarieIsOn = $questionnarie->status;
        $readingIsOn = $questionnarie->reading->status;

        if ($questionnarieIsOn && $readingIsOn) {
            return $next($request);
        }

        return abort(403, 'Acción no autorizada');
    }
}
