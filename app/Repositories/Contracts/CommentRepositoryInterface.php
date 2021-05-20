<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CommentRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface CommentRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $id
     * @param $model
     * @return mixed
     */
    public function getCommentsByRecordId($id, $model);

    /**
     * @param $input
     * @param $user
     * @return mixed
     */
    public function createComment($input, $user);
}