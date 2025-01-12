<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ContactController extends Controller
{
    public function create()
    {
        // Get all admin users
        $admins = User::where('role', 'admin')->get();
        return view('contact.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'admin_email' => 'required|email|exists:users,email'
        ]);

        $contact = Contact::create($validated);

        // Send email to selected admin
        Mail::to($validated['admin_email'])->send(new ContactFormMail($contact));

        return redirect()->back()->with('status', 'Message sent successfully!');
    }
}