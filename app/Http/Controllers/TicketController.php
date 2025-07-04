<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use App\Mail\RegistrationAdminNotification;

class TicketController extends Controller
{
    public function create()
    {
        return view('ticket.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'         => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'email'              => 'required|email|unique:tickets,email',
            'phone'              => 'nullable|string|max:20',
            'job_title'          => 'nullable|string|max:255',
            'company'            => 'nullable|string|max:255',
            'country'            => 'nullable|string|max:255',
            'linkedin'           => 'nullable|url|max:255',
            'industry'           => 'nullable|string|max:255',
            'company_size'       => 'nullable|string|max:50',
            'experience'         => 'nullable|string|max:50',
            'interests'          => 'nullable|array',
            'meeting_topics'     => 'nullable|array',
            'consent_newsletter' => 'nullable',
            'consent_thirdparty' => 'nullable',
        ]);

        $validated['consent_newsletter'] = $request->has('consent_newsletter');
        $validated['consent_thirdparty'] = $request->has('consent_thirdparty');

        $ticket = Ticket::create($validated);
        if (!empty($validated['email'])) {
            Mail::to($validated['email'])->send(new RegistrationConfirmation($validated));
        }

        $adminEmail = env('MAIL_ADMIN_ADDRESS');
        if (!empty($adminEmail)) {
            Mail::to($adminEmail)->send(new RegistrationAdminNotification($validated));
        }


        return redirect()->route('ticket.thankyou', $ticket->id);
    }
}
