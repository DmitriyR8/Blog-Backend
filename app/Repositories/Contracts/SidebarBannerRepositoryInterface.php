<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SidebarBannerRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface SidebarBannerRepositoryInterface extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getReviewByHarcodeId();
}