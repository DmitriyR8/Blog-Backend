<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

/**
 * Class BlogArticle
 * @package App
 */
class BlogArticle extends Model
{
    const LIMIT = 3;

    const PAGINATE = 3;

    const TOTAL_LAST = 4;

    const TOTAL_POPULAR = 6;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'h1_title',
        'title',
        'description',
        'url',
        'views',
        'short_desc',
        'author',
        'read_time',
        'back_img',
        'back_alt_img',
        'main_quote',
        'img_main_quote',
        'alt_main_quote_img',
        'related_articles'
    ];

    /**
     * @param $relatedArticles
     * @return false|string
     */
    public function setRelatedArticlesAttribute($relatedArticles)
    {
        return $this->attributes['related_articles'] = json_encode($relatedArticles);
    }

    /**
     * @param $relatedArticles
     * @return array
     */
    public function getRelatedArticlesAttribute($relatedArticles)
    {
        return array_values($relatedArticles ? json_decode($relatedArticles, true) : []);
    }

    /**
     * @return MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
