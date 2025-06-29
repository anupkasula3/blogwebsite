<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'newsletter' => 'boolean'
        ]);

        // Store contact form data (you can create a Contact model if needed)
        $contactData = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'newsletter' => $request->has('newsletter'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now()
        ];

        // Send email notification
        try {
            $adminEmail = \App\Models\Setting::get('contact_email', 'admin@myblogsite.com');
            Mail::to($adminEmail)->send(new ContactFormMail($contactData));
        } catch (\Exception $e) {
            // Log the error but don't fail the form submission
            \Log::error('Contact form email failed: ' . $e->getMessage());
        }

        // Send confirmation email to user
        try {
            Mail::to($request->email)->send(new ContactFormMail($contactData, true));
        } catch (\Exception $e) {
            \Log::error('Contact form confirmation email failed: ' . $e->getMessage());
        }

        return redirect()->route('contact')
            ->with('success', 'Thank you for your message! We\'ll get back to you soon.');
    }
}
