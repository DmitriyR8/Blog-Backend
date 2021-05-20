<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CommentUserRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface CommentUserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function createUser($data);
}