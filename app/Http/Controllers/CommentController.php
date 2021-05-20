<?php

namespace App\Http\Controllers;

use App\BlogArticle;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\CommentUserRepositoryInterface;
use App\SingleReview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * @var CommentRepositoryInterface
     */
    protected $commentRepository;

    /**
     * @var CommentUserRepositoryInterface
     */
    protected $commentUserRepository;

    /**
     * CommentController constructor.
     * @param CommentRepositoryInterface $commentRepository
     * @param CommentUserRepositoryInterface $commentUserRepository
     */
    public function __construct(
        CommentRepositoryInterface $commentRepository,
        CommentUserRepositoryInterface $commentUserRepository
    )
    {
        $this->commentRepository = $commentRepository;
        $this->commentUserRepository = $commentUserRepository;
    }

    /**
     * @param $commentType
     * @param $id
     * @return JsonResponse
     */
    public function index($commentType, $id)
    {

        switch ($commentType) {
            case 'article':
                $model = BlogArticle::class;
                break;
            case 'review':
                $model = SingleReview::class;
                break;
            default:
                $model = "";
                break;
        }

        $getComment = $this->commentRepository->getCommentsByRecordId($id, $model);

        return response()->json([
            'data' => $getComment,
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'rating' => 'required',
            'title' => 'required',
            'comment_body' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->messages(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        $createUser = $this->commentUserRepository->createUser($input);

        switch ($input['type']) {
            case 'single_review':
                $input['commentable_id'] = $input['single_review_id'];
                $input['commentable_type'] = SingleReview::class;
                break;
            case 'blog_article':
                $input['commentable_id'] = $input['blog_article_id'];
                $input['commentable_type'] = BlogArticle::class;
                break;
            default:
                break;
        }

        $createComment = $this->commentRepository->createComment($input, $createUser);

        return response()->json([
            'data' => $createComment,
            'status' => Response::HTTP_OK,
        ]);
    }

}
