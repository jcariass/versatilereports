<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidarPermisos
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
        //Realizar validaciones en el middleware
        if(session("permisos_rol") != null){
            $url = explode("?", $request->getRequestUri())[0];
            foreach(session("permisos_rol") as $permiso_rol){
                if (strpos($url, $permiso_rol["url"]) !== false) {
                    if ($request->isMethod($permiso_rol["method"])) {
                        if($permiso_rol["url_identica"] == 1){
                            if($permiso_rol["url"] == $url){
                                return $next($request); 
                            }
                        }else{
                            return $next($request);               
                        }
                    }
                }
            }
            abort(403, "NO AUTORIZADO");
        }
        abort(403, "SIN PERMISOS");
    }
}
