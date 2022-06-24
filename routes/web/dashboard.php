<?php

use App\Http\Controllers\Dashboard\TicketController;

Route::prefix('dashboard')->name('dashboard.')->group(function() {
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

    Route::get('/tickets/read/{ticket}', [TicketController::class, 'read'])->name('tickets.read');

    Route::get('/tickets/edit/{ticket}', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/update/{ticket}', [TicketController::class, 'update'])->name('tickets.update');

    Route::get('/tickets/new', [TicketController::class, 'new'])->name('tickets.new');
    Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
});
