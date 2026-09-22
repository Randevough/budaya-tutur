<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('kontak');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Silent Honeypot validation (bots fill hidden field)
        if ($request->filled('website_url')) {
            return back()->with('success', 'Pesan Anda telah berhasil dikirimkan.');
        }

        // 2. Standard validation
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:3000',
        ]);

        // 3. Safety net: save to database FIRST
        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? 'Pesan Narahubung Budaya Tutur',
            'message' => $validated['message'],
            'is_sent_via_smtp' => false,
        ]);

        // 4. Attempt SMTP email transmission in try/catch block
        try {
            $toEmail = config('mail.from.address');

            Mail::raw(
                "Pesan baru dari situs Budaya Tutur:\n\n" .
                "Nama: {$contactMessage->name}\n" .
                "Email: {$contactMessage->email}\n" .
                "Subjek: {$contactMessage->subject}\n\n" .
                "Isi Pesan:\n{$contactMessage->message}\n\n" .
                "---\nTerkirim pada: " . now()->format('d M Y, H:i') . " WIB",
                function ($mail) use ($toEmail, $contactMessage) {
                    $mail->to($toEmail)
                        ->replyTo($contactMessage->email, $contactMessage->name)
                        ->subject("[Budaya Tutur] " . $contactMessage->subject);
                }
            );

            $contactMessage->update(['is_sent_via_smtp' => true]);
        } catch (Exception $e) {
            // Log SMTP failure for debugging while safeguarding user experience
            Log::warning("SMTP delivery failed for contact message #{$contactMessage->id}: " . $e->getMessage());
        }

        return back()->with('success', 'Terima kasih. Pesan Anda telah tersimpan dan akan ditinjau oleh tim arsip kami.');
    }
}
