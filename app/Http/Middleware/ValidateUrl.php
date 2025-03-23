<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->input("img_url"); //obtiene la url de la img

        //si la url es correcta
        if(filter_var($url, FILTER_VALIDATE_URL)){
            return $next($request);
        } else {
            return response(view('welcome', ["status" => "URL de la imagen incorrecta"])); //status =>... headers
        }
    }
}
