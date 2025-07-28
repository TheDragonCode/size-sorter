<?php

declare(strict_types=1);

use Tests\TestCase;

pest()
    ->printer()
    ->compact();

pest()
    ->uses(TestCase::class)
    ->in('Unit');
