<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
  public function __construct()
  {
    $this->modelKlass = '\\App\\Models\\'
      . preg_replace('/.*\\\\(.+)Controller/', '$1', get_called_class());
  }
}
