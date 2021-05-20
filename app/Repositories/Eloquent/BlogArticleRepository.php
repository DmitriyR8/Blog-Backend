<?php

namespace App\Repositories\Eloquent;

use App\BlogArticle;
use App\Repositories\Contracts\BlogArticleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BlogArticleRepository
 * @package App\Repositories\Eloquent
 */
class BlogArticleRepository extends BaseRepository implements BlogArticleRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BlogArticle::class;
    }

    /**
     * @return mixed
     */
    public function getTopArticles()
    {
        return $this->model->with(['comments' => function($query){
            $query->where('approve', true)
                ->orderBy('created_at', 'desc');
        }])->orderBy('created_at', 'desc')->take(BlogArticle::LIMIT)->get();
    }

    /**
     * @return mixed
     */
    public function getArticlesByViews()
    {
        return $this->model->with(['comments' => function($query){
            $query->where('approve', true)
                ->orderBy('created_at', 'desc');
        }])->orderBy('views', 'desc')->take(BlogArticle::TOTAL_POPULAR)->get();
    }

    /**
     * @return mixed
     */
    public function getArticlesByPublishedDate()
    {
        return $this->model->with(['comments' => function($query){
            $query->where('approve', true)
                ->orderBy('created_at', 'desc');
        }])->orderBy('created_at', 'desc')->take(BlogArticle::TOTAL_LAST)->get();
    }

    /**
     * @param $input
     * @return LengthAwarePaginator|mixed
     */
    public function getAllArticles($input)
    {
        return $this->model->with(['comments' => function($query){
            $query->where('approve', true)
                ->orderBy('created_at', 'desc');
        }])->orderBy('views', 'desc')->paginate($input['per_page']??BlogArticle::PAGINATE);
    }

    /**
     * @return mixed|void
     */
    public function getLastArticle()
    {
        return $this->model->with(['comments' => function($query){
            $query->where('approve', true)
                ->orderBy('created_at', 'desc');
        }])->orderBy('created_at', 'desc')->first();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getArticleById($slug)
    {
        return $this->model->with(['comments' => function($query){
            $query->with('user')
                ->where('approve', true)
                ->orderBy('created_at', 'desc');
        }])->where('slug', $slug)->get();
    }

    /**
     * @param $input
     * @return mixed
     */
    public function searchByArticles($input)
    {
        return $this->model->where('h1_title', 'LIKE', '%'.$input.'%')
            ->orWhere('title', 'LIKE', '%'.$input.'%')
            ->orWhere('short_desc', 'LIKE', '%'.$input.'%')
            ->orWhere('author', 'LIKE', '%'.$input.'%')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}