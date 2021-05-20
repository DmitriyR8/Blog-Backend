<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Discount
 * @package App
 */
class Discount extends Model
{
    const PAGINATE = 3;

    protected $fillable = [
        'discount_code',
        'url',
        'description',
        'percent',
        'hardcode_id',
        'logo',
    ];
}
