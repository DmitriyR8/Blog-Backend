<?php

namespace App\Service\Search;

use App\Repositories\Contracts\BlogArticleRepositoryInterface;
use App\Repositories\Contracts\SingleReviewRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * Class SearchService
 * @package App\Service\Search
 */
class SearchService implements SearchServiceInterface
{
    const PAGE = 1;

    const PER_PAGE = 6;

    /**
     * @var SingleReviewRepositoryInterface
     */
    protected $singleReviewRepository;
    /**
     * @var BlogArticleRepositoryInterface
     */
    protected $blogArticleRepository;

    /**
     * SearchService constructor.
     * @param SingleReviewRepositoryInterface $singleReviewRepository
     * @param BlogArticleRepositoryInterface $blogArticleRepository
     */
    public function __construct
    (
        SingleReviewRepositoryInterface $singleReviewRepository,
        BlogArticleRepositoryInterface $blogArticleRepository
    )
    {
        $this->singleReviewRepository = $singleReviewRepository;
        $this->blogArticleRepository = $blogArticleRepository;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function getResult($input)
    {
        $singleReviews = $this->singleReviewRepository->searchByReviews($input['query']);

        $blogArticles = $this->blogArticleRepository->searchByArticles($input['query']);

        $records = $singleReviews->mergeRecursive($blogArticles);

        $items = $this->paginate($records, self::PER_PAGE, $input['page'] ?? self::PAGE);

        return $items;
    }

    /**
     * @param $items
     * @param int $perPage
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    private function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}