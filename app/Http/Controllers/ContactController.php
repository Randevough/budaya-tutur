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

        // 2. Standard validation with anti-abuse max character caps
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:1000',
        ], [
            'name.max' => 'Nama lengkap maksimal 100 karakter.',
            'email.max' => 'Alamat email maksimal 100 karakter.',
            'subject.max' => 'Subjek maksimal 200 karakter.',
            'message.max' => 'Isi pesan maksimal 1.000 karakter.',
        ]);

        // 3. Security Sanitization (Defense-in-depth against XSS & CRLF Email Header Injection)
        $cleanName = trim(preg_replace('/[\r\n\t]+/', ' ', strip_tags($validated['name'])));
        $cleanEmail = trim(filter_var($validated['email'], FILTER_SANITIZE_EMAIL));
        $rawSubject = $validated['subject'] ?? 'Pesan Narahubung Budaya Tutur';
        $cleanSubject = trim(preg_replace('/[\r\n\t]+/', ' ', strip_tags($rawSubject))) ?: 'Pesan Narahubung Budaya Tutur';
        $cleanMessage = trim(strip_tags($validated['message']));

        // 4. Safety net: save sanitized data to database FIRST
        $contactMessage = ContactMessage::create([
            'name' => $cleanName,
            'email' => $cleanEmail,
            'subject' => $cleanSubject,
            'message' => $cleanMessage,
            'is_sent_via_smtp' => false,
        ]);

        // 4. Attempt SMTP email transmission in try/catch block
        try {
            $toEmail = env('CONTACT_NOTIFICATION_EMAIL', config('mail.from.address'));

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
