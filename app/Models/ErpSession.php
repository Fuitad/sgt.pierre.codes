<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErpSession extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ticks' => 'collection',
        'scores' => 'collection',
        'start_time' => 'datetime',
    ];
}
