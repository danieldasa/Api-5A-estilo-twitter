<?php

namespace App\Http\Middleware;

use Closure;

class TypeJSON
{
/**
* Handle an incoming request.
*
* @param  \Illuminate\Http\Request  $request
* @param  \Closure  $next
* @return mixed
*/
public function handle($request, Closure $next)
{
if(!$request->hasFile('imagen'))
{
    if($request->header('Content-Type')!= "application/json")
    {
        $repuesta = array('error'=> "La petición tiene que ser en formato JSON", 'clave'=>500);
        return response()->json($repuesta,500);
    }
}
return $next($request);
} 
}


