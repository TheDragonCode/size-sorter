<?php

declare(strict_types=1);

namespace Tests\Fixtures\Objects;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $value
 */
class LaravelModel extends Model
{
    protected $fillable = [
        'id',
        'value',
    ];
}
