<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChargeAddRequest;
use App\Interfaces\ChargeInterface;
use Exception;

class ChargeController extends Controller
{
    protected $chargeRepository;
    public function __construct(ChargeInterface $chargeRepository)
    {
        $this->chargeRepository = $chargeRepository;
    }

    public function add_credit(ChargeAddRequest $request)
    {
        try {
            [$user, $history] = $this->chargeRepository->create($request->amount);

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'charge' => $history
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function get_history()
    {
        try {
            $history = $this->chargeRepository->list_all();

            return response()->json([
                'success' => true,
                'data' => $history
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }
}
