<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class SingleReview
 * @package App
 */
class SingleReview extends Model
{
    const RECOMMENDED = 4.0;

    const NEGATIVE = 3.9;

    const PAGINATE = 9;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'h1_title',
        'title',
        'description',
        'overall_rating',
        'quality',
        'price',
        'customer_support',
        'author',
        'back_img',
        'back_alt_img',
        'short_desc',
        'text',
        'hardcode_id',
        'link',
        'main_quote',
        'img_main_quote',
        'alt_main_quote_img',
        'url',
        'logo'
    ];

    /**
     * @return MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
