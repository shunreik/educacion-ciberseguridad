<?php

namespace App\Http\Middleware;

use App\Models\Score;
use Closure;
use Illuminate\Http\Request;

class ScoreOwner
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
        $userId = $request->user()->id;
        $scoreId = is_numeric($request->route('score')) ?
            Score::findOrFail($request->route('score'))->user_id :
            $request->route('score')->user_id;

        if ($userId !== $scoreId) {
            return abort(403, 'Acción no autorizada');
        }
        return $next($request);
    }
}
