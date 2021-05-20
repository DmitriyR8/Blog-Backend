<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BlogArticleRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogArticleController
 * @package App\Http\Controllers
 */
class BlogArticleController extends Controller
{
    /**
     * @var BlogArticleRepositoryInterface
     */
    protected $blogArticleRepository;

    /**
     * BlogArticleController constructor.
     * @param BlogArticleRepositoryInterface $blogArticleRepository
     */
    public function __construct(BlogArticleRepositoryInterface $blogArticleRepository)
    {
        $this->blogArticleRepository = $blogArticleRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $topArticles = $this->blogArticleRepository->getTopArticles();

        return response()->json([
            'data' => $topArticles,
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getPopular()
    {
        $popularArticles = $this->blogArticleRepository->getArticlesByViews();

        return response()->json([
            'data' => $popularArticles,
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getLatest()
    {
        $latestArticles = $this->blogArticleRepository->getArticlesByPublishedDate();

        return response()->json([
            'data' => $latestArticles,
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function headArticle()
    {
        $headArticle = $this->blogArticleRepository->getLastArticle();

        return response()->json([
            'data' => $headArticle,
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request)
    {
        $input = $request->all();

        $getAllArticles = $this->blogArticleRepository->getAllArticles($input);

        return response()->json([
            'data' => $getAllArticles,
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @param $slug
     * @return void
     */
    public function getArticle($slug)
    {
        $article = $this->blogArticleRepository->getArticleById($slug);

        return response()->json([
            'data' => $article,
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @param $slug
     * @return BinaryFileResponse
     */
    public function getImage($slug)
    {
        $article = json_decode($this->blogArticleRepository->getArticleById($slug), true);

        foreach ($article as $value) {
            $fileName = $value['back_img'];
        }

        $file = storage_path("app/public/upload/{$fileName}");
        $header = [
            'Content-Disposition' => 'inline; filename="'. $fileName .'"'
        ];
        return response()->file($file, $header);

    }
}