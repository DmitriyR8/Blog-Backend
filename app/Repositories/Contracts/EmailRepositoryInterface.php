<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface EmailRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface EmailRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function createEmail($data);
}