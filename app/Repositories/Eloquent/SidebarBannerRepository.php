<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\SidebarBannerRepositoryInterface;
use App\SingleReview;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SidebarBannerRepository
 * @package App\Repositories\Eloquent
 */
class SidebarBannerRepository extends BaseRepository implements SidebarBannerRepositoryInterface
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
     * @return mixed
     */
    public function getReviewByHarcodeId()
    {
        return $this->model->whereBetween('hardcode_id', [1,3])->get();
    }
}