<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\EmailRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EmailController
 * @package App\Http\Controllers
 */
class EmailController extends Controller
{
    /**
     * @var EmailRepositoryInterface
     */
    protected $emailRepository;

    /**
     * EmailController constructor.
     * @param EmailRepositoryInterface $emailRepository
     */
    public function __construct(EmailRepositoryInterface $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required|unique:emails,email',
            'action' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->messages(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        $createEmail = $this->emailRepository->createEmail($input);

        return response()->json([
            'data' => $createEmail,
            'status' => Response::HTTP_OK,
        ]);
    }
}
