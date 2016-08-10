<?php

namespace App\Http\Controllers\Rest;

use App\Behaviours\RestfulBehaviour;
use App\Contracts\RestfulContract;

class ErpSessionController extends BaseController implements RestfulContract
{
    use RestfulBehaviour;

    public function __construct()
    {
        $this->modelAttributes = [
            'tics', 'scores', 'start_time', 'duration',
        ];

        parent::__construct();
    }
}
