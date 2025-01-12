<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use App\Http\Controllers\Controller;


class ContactController extends Controller
{
    
    public function index()
    {
        $messages = Contact::latest()->paginate(10);
        return view('contact.index', compact('messages'));
    }

    public function create()
    {
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

        Contact::create($validated);

        return redirect()->back()->with('status', 'Message sent successfully!');
    }

    
}