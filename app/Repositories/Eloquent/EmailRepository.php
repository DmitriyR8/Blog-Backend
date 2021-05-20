<?php

namespace App\Repositories\Eloquent;

use App\Email;
use App\Repositories\Contracts\EmailRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class EmailRepository
 * @package App\Repositories\Eloquent
 */
class EmailRepository extends BaseRepository implements EmailRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Email::class;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createEmail($data)
    {
        return $this->model->create([
            'email' => $data['email'],
            'action' => $data['action']
        ]);
    }
}