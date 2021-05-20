<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\SingleReviewRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SingleReviewController
 * @package App\Http\Controllers
 */
class SingleReviewController extends Controller
{

    /**
     * @var SingleReviewRepositoryInterface
     */
    protected $singleReviewRepository;

    /**
     * SingleReviewController constructor.
     * @param SingleReviewRepositoryInterface $singleReviewRepository
     */
    public function __construct(SingleReviewRepositoryInterface $singleReviewRepository)
    {
        $this->singleReviewRepository = $singleReviewRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $input = $request->get('filter');

        $allReviews = $this->singleReviewRepository->getReviewsByFilter($input);

        return response()->json([
            'data' => $allReviews,
            'filter' => $input,
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function topReviews()
    {
        $topReviews = $this->singleReviewRepository->getTopReviews();

        return response()->json([
            'data' => $topReviews,
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getReview($slug)
    {
        $review = $this->singleReviewRepository->getReviewById($slug);

        return response()->json([
            'data' => $review,
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * @param $slug
     * @return BinaryFileResponse
     */
    public function getImage($slug)
    {
        $review = json_decode($this->singleReviewRepository->getReviewById($slug), true);

        foreach ($review as $value) {
            $fileName = $value['back_img'];
        }

        $file = storage_path("app/public/upload/{$fileName}");
        $header = [
            'Content-Disposition' => 'inline; filename="'. $fileName .'"'
        ];

        return response()->file($file, $header);
    }

    /**
     * @param $slug
     * @return BinaryFileResponse
     */
    public function getLogoImage($slug)
    {
        $review = json_decode($this->singleReviewRepository->getReviewById($slug), true);

        foreach ($review as $value) {
            $fileName = $value['logo_img'];
        }

        $file = storage_path("app/public/upload/{$fileName}");
        $header = [
            'Content-Disposition' => 'inline; filename="'. $fileName .'"'
        ];

        return response()->file($file, $header);
    }


}
