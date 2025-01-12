<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FAQController extends Controller
{
    //Add methods for creating, updating, and deleting news w isadmin protec ofc
    public function create(): View
    {
        return view('faq.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        FAQ::create($validated);

        return redirect()->route('dashboard')->with('status', 'faq-created');
    }

    public function edit(FAQ $faq): View
    {
        return view('faq.editfaq', compact('faq'));
    }

    public function update(Request $request, FAQ $faq): RedirectResponse
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        $faq->update($validated);

        return redirect()->route('dashboard')->with('status', 'faq-updated');
    }

    public function destroy(FAQ $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('dashboard')->with('status', 'faq-deleted');
    }
}
