<?php

namespace App\Http\Middleware;

use App\Models\Questionnarie;
use Closure;
use Illuminate\Http\Request;

class CompletedQuestionnarie
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
        $questionnarieId = is_numeric($request->route('questionnarie')) ?
            $request->route('questionnarie') :
            $request->route('questionnarie')->id;

        $user = $request->user();
        //Se verifica si el usuario ya tiene un puntaje bajo ese questionario
        $userHasQuestionnarie = $user->scores()->where('questionnarie_id', $questionnarieId)->first();

        if(is_null($userHasQuestionnarie)){
            return $next($request);
        }

        return abort(403, 'Acción no autorizada');
    }
}
