<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketCreateRequest;
use App\Http\Requests\TicketEditRequest;
use App\Http\Requests\TicketMessageRequest;
use App\Interfaces\Services\TicketServiceInterface;
use Exception;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;
    public function __construct(TicketServiceInterface $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function get_ticket(Request $request)
    {
        try {
            $id = $request->id;

            [$ticket, $messages] = $this->ticketService->get_ticket_by_id($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'ticket' => $ticket,
                    'messages' => $messages
                ]
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], $e->getCode() ?? 500);
        }
    }

    public function get_tickets()
    {
        try {
            $user_id = auth()->user()->id;
            $tickets = $this->ticketService->get_ticket_by_user($user_id);

            return response()->json([
                'success' => true,
                'data' => $tickets
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], $e->getCode() ?? 500);
        }
    }

    public function create_ticket(TicketCreateRequest $request)
    {
        try {
            $user_id = auth()->user()->id;
            $ticket = $this->ticketService->create_ticket(
                $user_id,
                $request->title,
                $request->message,
                $request->category
            );

            return response()->json([
                'success' => true,
                'data' => $ticket
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], $e->getCode() ?? 500);
        }
    }

    public function edit_ticket(TicketEditRequest $request)
    {
        try {
            $ticket = $this->ticketService->update_ticket($request->id, $request->status);

            return response()->json([
                'success' => true,
                'data' => $ticket
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], $e->getCode() ?? 500);
        }
    }

    public function add_ticket_message(TicketMessageRequest $request)
    {
        try {
            $user_id = auth()->user()->id;
            $ticket = $this->ticketService->create_ticket_message(
                $request->id,
                $user_id,
                $request->message
            );

            return response()->json([
                'success' => true,
                'data' => $ticket
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], $e->getCode() ?? 500);
        }
    }
}
