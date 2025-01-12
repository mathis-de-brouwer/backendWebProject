<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class FAQController extends Controller
{
    public function create(): View
    {
        return view('faq.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        FAQ::create($validated);

        return redirect()->route('dashboard')->with('status', 'question-submitted');
    }

    public function edit(FAQ $faq): View
    {
        return view('faq.edit', compact('faq'));
    }

    public function answer(Request $request, FAQ $faq): RedirectResponse
    {
        $validated = $request->validate([
            'answer' => 'required|string'
        ]);

        $faq->update([
            'answer' => $validated['answer'],
            'status' => 'answered',
            'answered_by' => Auth::id()
        ]);

        return redirect()->route('dashboard')->with('status', 'faq-answered');
    }

    public function destroy(FAQ $faq): RedirectResponse
    {
        $faq->delete();
        return redirect()->route('dashboard')->with('status', 'faq-deleted');
    }
}