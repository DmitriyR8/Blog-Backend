<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CommentUser
 * @package App
 */
class CommentUser extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email'];


    /**
     * @return BelongsTo
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'user_id');
    }
}
