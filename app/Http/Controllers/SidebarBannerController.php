<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\SidebarBannerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SidebarBannerController
 * @package App\Http\Controllers
 */
class SidebarBannerController extends Controller
{
    /**
     * @var SidebarBannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * SidebarBannerController constructor.
     * @param SidebarBannerRepositoryInterface $bannerRepository
     */
    public function __construct(SidebarBannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {

        $sidebarBanner = $this->bannerRepository->getReviewByHarcodeId();

        return response()->json([
            'data' => $sidebarBanner,
            'status' => Response::HTTP_OK,
        ]);
    }
}
