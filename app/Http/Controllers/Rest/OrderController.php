<?php

namespace App\Http\Controllers\Rest;

use App\Behaviours\RestfulBehaviour;
use App\Contracts\RestfulContract;
use App\Models\Order;

class OrderController extends BaseController
  implements RestfulContract
{
  use RestfulBehaviour;

  public function __construct()
  {
    parent::__construct();
  }
}
