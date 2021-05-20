<?php

namespace App\Repositories\Eloquent;

use App\CommentUser;
use App\Repositories\Contracts\CommentUserRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CommentUserRepository
 * @package App\Repositories\Eloquent
 */
class CommentUserRepository extends BaseRepository implements CommentUserRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CommentUser::class;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createUser($data)
    {
        return $this->model->firstOrCreate([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }
}