<?php

namespace App\Repositories\Eloquent;

use App\Discount;
use App\Repositories\Contracts\DiscountRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DiscountRepository
 * @package App\Repositories\Eloquent
 */
class DiscountRepository extends BaseRepository implements DiscountRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Discount::class;
    }

    /**
     * @return mixed|void
     */
    public function getDiscounts()
    {
        return $this->model->orderBy('created_at', 'desc')->paginate(Discount::PAGINATE);
    }

    /**
     * @return mixed
     */
    public function getTopDiscounts()
    {
        return $this->model->whereBetween('hardcode_id', [1, 3])->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function GetDiscountById($id)
    {
        return $this->model->findOrFail($id);
    }
}