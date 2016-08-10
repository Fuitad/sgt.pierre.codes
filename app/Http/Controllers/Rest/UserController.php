<?php

namespace App\Http\Controllers\Rest;

use App\Behaviours\RestfulBehaviour;
use App\Contracts\RestfulContract;
use App\Models\User;


class UserController extends BaseController
  implements RestfulContract
{
  use RestfulBehaviour;

  public function __construct()
  {
    $this->modelAttributes = [
      'email', 'username', 'role'
    ];

    parent::__construct();
  }
}
