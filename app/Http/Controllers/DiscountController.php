<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DiscountRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class DiscountController
 * @package App\Http\Controllers
 */
class DiscountController extends Controller
{

    /**
     * @var Response
     */
    protected $response;
    /**
     * @var DiscountRepositoryInterface
     */
    protected $discountRepository;

    /**
     * DiscountController constructor.
     * @param Response $response
     * @param DiscountRepositoryInterface $discountRepository
     */
    public function __construct(Response $response, DiscountRepositoryInterface $discountRepository)
    {

        $this->response = $response;
        $this->discountRepository = $discountRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $allDiscounts = $this->discountRepository->getDiscounts();

        return response()->json([
            'data' => $allDiscounts,
            'status' => $this->response->status(),
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function topDiscounts()
    {

        $topDiscounts = $this->discountRepository->getTopDiscounts();

        return response()->json([
            'data' => $topDiscounts,
            'status' => $this->response->status(),
        ]);
    }

    public function getDiscountById($id)
    {
        $discount = $this->discountRepository->GetDiscountById($id);

        return response()->json([
            'data' => $discount,
            'status' => $this->response->status(),
        ]);
    }

    /**
     * @param $id
     * @return BinaryFileResponse
     */
    public function getImage($id)
    {
        $discount = json_decode($this->discountRepository->GetDiscountById($id), true);

        $fileName = $discount['logo'];
        $file = storage_path("app/public/upload/{$fileName}");
        $header = [
            'Content-Disposition' => 'inline; filename="'. $fileName .'"'
        ];

        return response()->file($file, $header);
    }
}
