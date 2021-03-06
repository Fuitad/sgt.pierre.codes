<?php
// taken from: https://gist.github.com/danharper/06d2386f0b826b669552

namespace App\Http\Middleware;

class EnableCors
{
  public function handle($request, \Closure $next)
  {
    $response = $next($request);
    $response->header(
      'Access-Control-Allow-Methods',
      'GET, POST, PUT, PATCH, DELETE'
    );

    $response->header(
      'Access-Control-Allow-Headers',
      $request->header('Access-Control-Request-Headers')
    );

    $response->header('Access-Control-Allow-Origin', '*');

    return $response;
  }
}
