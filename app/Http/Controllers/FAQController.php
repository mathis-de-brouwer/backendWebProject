<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = FAQ::orderBy('category')
                   ->get()
                   ->groupBy('category');

        return view('faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string|max:1000',
            'answer' => 'required|string|max:5000'
        ]);

        FAQ::create($validated);

        return redirect()->route('faq.index')
                        ->with('status', 'FAQ created successfully.');
    }

    public function edit(FAQ $faq)
    {
        return view('faq.edit', compact('faq'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string|max:1000',
            'answer' => 'required|string|max:5000'
        ]);

        $faq->update($validated);

        return redirect()->route('faq.index')
                        ->with('status', 'FAQ updated successfully.');
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->route('faq.index')
                        ->with('status', 'FAQ deleted successfully.');
    }
}
