<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(TicketRepository $ticketRepository, Request $request): View
    {
        $filterData = $request->query->get('filterData', []);

        return view('dashboard.ticket.index', [
            'tickets' => $ticketRepository->findAll($filterData),
            'filterData' => $filterData
        ]);
    }

    public function read(Ticket $ticket): View
    {
        return view('dashboard.ticket.read', [
            'ticket' => $ticket
        ]);
    }

    public function edit(Ticket $ticket): View
    {
        return view('dashboard.ticket.form', [
            'ticket' => $ticket
        ]);
    }

    public function update(Ticket $ticket, TicketRepository $ticketRepository, TicketRequest $request): RedirectResponse
    {
        $ticketRepository->update(
            $ticket,
            array_merge(
                $request->validated(),
                [
                    'author_id' => Auth::user()->id
                ]
            )
        );
        return redirect()->route('dashboard.tickets.edit', ['ticket' => $ticket])->with('success', __('Ticket updated!'));
    }

    public function new(): View
    {
        return view('dashboard.ticket.form', [
            'ticket' => new Ticket()
        ]);
    }

    public function store(TicketRepository $ticketRepository, TicketRequest $request): RedirectResponse
    {
        $ticket = $ticketRepository->store(
            array_merge(
                $request->validated(),
                [
                    'author_id' => Auth::user()->id
                ]
            )
        );

        return redirect()->route('dashboard.tickets.read', [
            'ticket' => $ticket
        ])->with('success', __('Ticket stored!'));
    }
}
