<?php

namespace App\Interfaces\Services;

use Exception;
use Illuminate\Database\Eloquent\Collection;

interface ChargeServiceInterface
{
    public function get_charge_history_by_user($user_id): Collection | Exception;
    public function add_credit_to_user($user_id, $amount): array | Exception;
}
