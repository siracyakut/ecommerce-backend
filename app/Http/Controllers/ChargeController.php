<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChargeAddRequest;
use App\Interfaces\Services\ChargeServiceInterface;
use Exception;

class ChargeController extends Controller
{
    protected $chargeService;
    public function __construct(ChargeServiceInterface $chargeService)
    {
        $this->chargeService = $chargeService;
    }

    public function add_credit(ChargeAddRequest $request)
    {
        try {
            $user_id = auth()->user()->id;
            [$user, $history] = $this->chargeService->add_credit_to_user($user_id, $request->amount);

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'charge' => $history
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], $e->getCode() ?? 500);
        }
    }

    public function get_history()
    {
        try {
            $user_id = auth()->user()->id;
            $history = $this->chargeService->get_charge_history_by_user($user_id);

            return response()->json([
                'success' => true,
                'data' => $history
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], $e->getCode() ?? 500);
        }
    }
}
