<?php

declare(strict_types=1);

namespace l3aro\FilamentRatingStar\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \l3aro\FilamentRatingStar\FilamentRatingStar
 */
class FilamentRatingStar extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \l3aro\FilamentRatingStar\FilamentRatingStar::class;
    }
}
