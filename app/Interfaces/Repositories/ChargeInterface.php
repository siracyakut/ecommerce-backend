<?php

namespace App\Interfaces\Repositories;

use App\Models\ChargeHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ChargeInterface
{
    public function list_history_by_user($user_id): Collection;
    public function add_credit($user_id, $amount): User;
    public function create_history($user_id, $amount): ChargeHistory;
}
