<?php

if (!function_exists('resource')) {
  function resource($basePath, $controller = null) {
    $app = app();

    $controller = $controller ?? title_case(
      str_replace('-', '', $basePath)
    ) . 'Controller';

    $app->get("$basePath", "{$controller}@index");
    $app->get("$basePath/{id}", "{$controller}@show");
    $app->put("$basePath/{id}", "{$controller}@update");
    $app->post("$basePath", "{$controller}@store");
    $app->delete("$basePath/{id}", "{$controller}@destroy");
  }
}
