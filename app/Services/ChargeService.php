<?php

namespace App\Services;

use App\Interfaces\Repositories\ChargeRepositoryInterface;
use App\Interfaces\Services\ChargeServiceInterface;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class ChargeService implements ChargeServiceInterface
{
    protected $chargeRepository;
    public function __construct(ChargeRepositoryInterface $chargeRepository)
    {
        $this->chargeRepository = $chargeRepository;
    }

    public function get_charge_history_by_user($user_id): Collection | Exception
    {
        $charges = $this->chargeRepository->list_history_by_user($user_id);

        if (!$charges->count()) throw new Exception('No charges found', 404);

        return $charges;
    }

    public function add_credit_to_user($user_id, $amount): array | Exception
    {
        $user = User::find($user_id);

        if (!$user) throw new Exception('User not found', 404);

        $user = $this->chargeRepository->add_credit($user->id, $amount);
        $history = $this->chargeRepository->create_history($user->id, $amount);

        return [$user, $history];
    }
}
