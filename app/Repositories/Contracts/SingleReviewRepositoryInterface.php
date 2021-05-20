<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SingleReviewRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface SingleReviewRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $input
     * @return mixed
     */
    public function getReviewsByFilter($input);

    /**
     * @return mixed
     */
    public function getTopReviews();

    /**
     * @param $slug
     * @return mixed
     */
    public function getReviewById($slug);

    /**
     * @param $input
     * @return mixed
     */
    public function searchByReviews($input);
}