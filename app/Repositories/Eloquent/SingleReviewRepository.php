<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\SingleReviewRepositoryInterface;
use App\SingleReview;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SingleReviewRepository
 * @package App\Repositories\Eloquent
 */
class SingleReviewRepository extends BaseRepository implements SingleReviewRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SingleReview::class;
    }

    /**
     * @param $input
     * @return Collection|Model[]|mixed
     */
    public function getReviewsByFilter($input)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        if ($input == 'recommended') {
            $query->where('overall_rating', '>=', SingleReview::RECOMMENDED);
        } elseif ($input == 'negative') {
            $query->where('overall_rating', '<=', SingleReview::NEGATIVE);
        }

        return $query->paginate(SingleReview::PAGINATE);
    }

    /**
     * @return mixed
     */
    public function getTopReviews()
    {
        return $this->model->whereBetween('hardcode_id', [1, 3])->get();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getReviewById($slug)
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
    public function searchByReviews($input)
    {
        return $this->model->where('h1_title', 'LIKE', '%'.$input.'%')
            ->orWhere('title', 'LIKE', '%'.$input.'%')
            ->orWhere('short_desc', 'LIKE', '%'.$input.'%')
            ->orWhere('author', 'LIKE', '%'.$input.'%')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}