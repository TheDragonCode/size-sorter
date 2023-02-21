<?php

declare(strict_types=1);

namespace Tests\Fixtures\Laravel\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $fillable = [
        'id',
        'value',
    ];
}
