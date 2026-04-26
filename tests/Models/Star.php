<?php

namespace l3aro\FilamentRatingStar\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $table = 'stars';

    protected $fillable = ['rating'];

    protected $casts = [
        'rating' => 'float',
    ];
}