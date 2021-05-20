<?php

namespace App\Repositories\Eloquent;

use App\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CommentRepository
 * @package App\Repositories\Eloquent
 */
class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    /**
     * @param $id
     * @param $model
     * @return LengthAwarePaginator|mixed
     */
    public function getCommentsByRecordId($id,$model)
    {
        return $this->model
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->where([
                'approve' => true,
                'commentable_id' => $id,
                'commentable_type' => $model
            ])->paginate(Comment::PAGINATE);
    }

    /**
     * @param $input
     * @param $user
     * @return mixed
     */
    public function createComment($input, $user)
    {
        return $this->model->create([
            'user_id' => $user->id,
            'rating' => $input['rating'],
            'title' => $input['title'],
            'comment_body' => $input['comment_body'],
            'type' => $input['type'],
            'commentable_id' =>$input['commentable_id'],
            'commentable_type' => $input['commentable_type']
        ]);
    }
}