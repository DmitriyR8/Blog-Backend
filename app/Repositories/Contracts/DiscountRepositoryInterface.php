<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface DiscountRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface DiscountRepositoryInterface extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getDiscounts();

    /**
     * @return mixed
     */
    public function getTopDiscounts();

    /**
     * @param $id
     * @return mixed
     */
    public function GetDiscountById($id);
}