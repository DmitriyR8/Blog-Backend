<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 * @package App
 */
class Email extends Model
{
    /**
     * @var array
     */
    protected $fillable =['email', 'action'];
}
