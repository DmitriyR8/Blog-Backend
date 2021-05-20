<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Comment
 * @package App
 */
class Comment extends Model
{
    const PAGINATE = 3;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'rating',
        'title',
        'comment_body',
        'approve',
        'commentable_id',
        'commentable_type',
    ];

    /**
     * @return MorphTo
     */

    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * @return HasMany
     */
    public function user()
    {
        return $this->hasMany(CommentUser::class,'id','user_id');
    }
}
