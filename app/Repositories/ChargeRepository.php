<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ChargeRepositoryInterface;
use App\Models\ChargeHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ChargeRepository implements ChargeRepositoryInterface
{
    protected $chargeHistory;
    protected $user;
    public function __construct(ChargeHistory $chargeHistory, User $user)
    {
        $this->chargeHistory = $chargeHistory;
        $this->user = $user;
    }

    public function list_history_by_user($user_id): Collection
    {
        $charges = $this->chargeHistory->where('user', $user_id)->get();
        return $charges;
    }

    public function add_credit($user_id, $amount): User
    {
        $_user = $this->user->find($user_id);
        $_user->credit = $_user->credit + $amount;
        $_user->save();
        return $_user;
    }

    public function create_history($user_id, $amount): ChargeHistory
    {
        $history = $this->chargeHistory->create([
            'user' => $user_id,
            'amount' => $amount
        ]);
        return $history;
    }
}
