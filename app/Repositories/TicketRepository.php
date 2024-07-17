<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TicketRepositoryInterface;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Database\Eloquent\Collection;

class TicketRepository implements TicketRepositoryInterface
{
    protected $ticket, $ticketMessage;
    public function __construct(Ticket $ticket, TicketMessage $ticketMessage)
    {
        $this->ticket = $ticket;
        $this->ticketMessage = $ticketMessage;
    }

    public function list_by_id($id): Ticket | null
    {
        return $this->ticket->find($id);
    }

    public function list_by_user($user_id): Collection
    {
        return $this->ticket->where('user', $user_id)->get();
    }

    public function list_ticket_messages($id): Collection
    {
        return $this->ticketMessage->with('user')->where('ticket', $id)->get();
    }

    public function create($user_id, $title, $message, $category): Ticket
    {
        return $this->ticket->create([
            'user' => $user_id,
            'status' => 'Bekliyor',
            'title' => $title,
            'message' => $message,
            'category' => $category
        ]);
    }

    public function create_message($id, $user_id, $message): TicketMessage
    {
        return $this->ticketMessage->create([
            'ticket' => $id,
            'user' => $user_id,
            'message' => $message
        ]);
    }

    public function update($id, $status): Ticket
    {
        $_ticket = $this->ticket->find($id);
        $_ticket->status = $status;
        $_ticket->save();
        return $_ticket;
    }
}
