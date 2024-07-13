<?php

namespace App\Repositories;

use App\Interfaces\ChargeInterface;
use App\Models\ChargeHistory;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class ChargeRepository implements ChargeInterface
{
    protected $chargeHistory;
    public function __construct(ChargeHistory $chargeHistory)
    {
        $this->chargeHistory = $chargeHistory;
    }

    public function list_all()
    {
        $user_id = auth()->user()->id;
        $charges = $this->chargeHistory->where('user', $user_id)->get();

        if (!$charges->count()) throw new Exception('No charges found');

        return $charges;
    }

    public function create($amount)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $user->credit = $user->credit + $amount;
        $user->save();

        $history = $this->chargeHistory->create([
            'user' => $user_id,
            'amount' => $amount
        ]);

        return [$user, $history];
    }
}
