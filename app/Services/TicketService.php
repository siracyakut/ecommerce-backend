<?php

namespace App\Services;

use App\Interfaces\Repositories\TicketRepositoryInterface;
use App\Interfaces\Services\TicketServiceInterface;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TicketService implements TicketServiceInterface
{
    protected $ticketRepository;
    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function get_ticket_by_id($id): array | Exception
    {
        $ticket = $this->ticketRepository->list_by_id($id);

        if (!$ticket) throw new Exception('Ticket not found', 404);
        if ($ticket->user != auth()->user()->id) throw new Exception('Permission denied', 403);

        $messages = $this->ticketRepository->list_ticket_messages($id);

        return [$ticket, $messages];
    }

    public function get_ticket_by_user($user_id): Collection | Exception
    {
        $tickets = $this->ticketRepository->list_by_user($user_id);

        if (!$tickets->count()) throw new Exception('Tickets not found', 404);

        return $tickets;
    }

    public function create_ticket($user_id, $title, $message, $category): Ticket
    {
        return $this->ticketRepository->create($user_id, $title, $message, $category);
    }

    public function create_ticket_message($id, $user_id, $message): TicketMessage | Exception
    {
        $ticket = $this->ticketRepository->list_by_id($id);

        if (!$ticket) throw new Exception('Ticket not found', 404);
        if ($ticket->user != $user_id) throw new Exception('Permission denied', 403);
        if ($ticket->status == 'Kapalı') throw new Exception('Ticket closed', 403);

        return $this->ticketRepository->create_message($id, $user_id, $message);
    }

    public function update_ticket($id, $status): Ticket | Exception
    {
        $ticket = $this->ticketRepository->list_by_id($id);

        if (!$ticket) throw new Exception('Ticket not found', 404);
        if ($ticket->user != auth()->user()->id) throw new Exception('Permission denied', 403);

        $ticket->status = $status;
        $ticket->save();

        return $ticket;
    }
}
