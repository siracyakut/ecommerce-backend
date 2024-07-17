<?php

namespace App\Interfaces\Repositories;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Database\Eloquent\Collection;

interface TicketRepositoryInterface
{
    public function list_by_id($id): Ticket | null;
    public function list_by_user($user_id): Collection;
    public function list_ticket_messages($id): Collection;
    public function create($user_id, $title, $message, $category): Ticket;
    public function create_message($id, $user_id, $message): TicketMessage;
    public function update($id, $status): Ticket;
}
