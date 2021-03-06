<?php
// taken from: https://gist.github.com/danharper/06d2386f0b826b669552

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * If the incoming request is an OPTIONS request
 * we will register a handler for the requested route
 */
class OptionsResponse extends ServiceProvider
{
  public function register()
  {
    $request = app('request');
    if ($request->isMethod('OPTIONS')) {
      app()->options($request->path(), function() {
        return response('', 200);
      });
    }
  }
}
