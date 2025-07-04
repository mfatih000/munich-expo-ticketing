<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [TicketController::class, 'create'])->name('ticket.create');
Route::post('/register', [TicketController::class, 'store'])->name('ticket.store');
Route::get('/thank-you/{id}', function ($id) {
    $ticket = \App\Models\Ticket::findOrFail($id);
    return view('ticket.thankyou', ['data' => $ticket]);
})->name('ticket.thankyou');
Route::middleware('auth.basic')->group(function () {
    Route::get('/admin/registrations', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.registrations');
    Route::get('/admin/export-csv', [App\Http\Controllers\AdminController::class, 'exportCsv'])->name('admin.exportCsv');
});
