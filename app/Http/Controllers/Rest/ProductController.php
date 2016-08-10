<?php

namespace App\Http\Controllers\Rest;

use App\Behaviours\RestfulBehaviour;
use App\Contracts\RestfulContract;
use App\Models\Product;

class ProductController extends BaseController
  implements RestfulContract
{
  use RestfulBehaviour;

  public function __construct()
  {
    $this->modelAttributes = [
      'sku', 'category', 'name', 'price', 'stock'
    ];

    parent::__construct();
  }
}
