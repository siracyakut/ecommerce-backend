<?php

namespace App\Interfaces\Services;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Exception;
use Illuminate\Database\Eloquent\Collection;

interface TicketServiceInterface
{
    public function get_ticket_by_id($id): array | Exception;
    public function get_ticket_by_user($user_id): Collection | Exception;
    public function create_ticket($user_id, $title, $message, $category): Ticket;
    public function create_ticket_message($id, $user_id, $message): TicketMessage | Exception;
    public function update_ticket($id, $status): Ticket | Exception;
}
