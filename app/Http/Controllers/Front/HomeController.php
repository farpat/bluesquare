<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(TicketRepository $ticketRepository)
    {
        return view('front.home.index', [
            'tickets' => $ticketRepository->findAll([])
        ]);
    }
}
