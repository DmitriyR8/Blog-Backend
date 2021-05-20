<?php

namespace App\Http\Controllers;

use App\Service\Search\SearchServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SearchController
 * @package App\Http\Controllers
 *
 */
class SearchController extends Controller
{
    /**
     * @var SearchServiceInterface
     */
    protected $searchService;

    /**
     * SearchController constructor.
     * @param SearchServiceInterface $searchService
     */
    public function __construct(SearchServiceInterface $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $input = $request->only(['query', 'page']);

        $validator = Validator::make($input, [
            'query' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->messages(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        $result = $this->searchService->getResult($input);

        return response()->json([
            'data' => $result,
            'query' => $input,
            'status' => Response::HTTP_OK,
        ]);
    }
}
