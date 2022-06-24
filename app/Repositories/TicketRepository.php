<?php

namespace App\Repositories;


use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class TicketRepository
{
    /**
     * @param array<string, string> $filterData
     * @return Collection<Ticket>|Ticket[]
     */
    public function findAll(array $filterData)
    {
        $query = Ticket::query()
            ->orderBy('updated_at', 'DESC')
            ->with('author');

        if (array_key_exists('type', $filterData)) {
            $query->where('type', $filterData['type']);
        }

        if (array_key_exists('status', $filterData)) {
            $query->where('status', $filterData['status']);
        }

        if (array_key_exists('priority', $filterData)) {
            $query->where('priority', $filterData['priority']);
        }

        return $query->get();
    }

    public function update(Ticket $ticket, array $ticketData): void
    {
        $ticket->update(
            array_merge($ticketData, ['updated_at' => Carbon::now()])
        );
    }

    public function store(array $ticketData): Ticket
    {
        $now = Carbon::now();

        $ticket = new Ticket(
            array_merge($ticketData, ['created_at' => $now])
        );
        $ticket->save();

        return $ticket;
    }
}
