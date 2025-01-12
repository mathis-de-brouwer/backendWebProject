<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;



class NewsController extends Controller
{
    //Add methods for creating, updating, and deleting FAQs use isadmin for protec
    public function index()
    {
        $news = News::latest('publicationDate')->get();
        $faqs = \App\Models\FAQ::all();
        return view('dashboard', [
            'news' => $news,
            'faqs' => $faqs
        ]);
    }

    public function create(): View
    {
        return view('news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news-images', 'public');
        }

        News::create($validated);

        return redirect()->route('dashboard')->with('status', 'news-created');
    }

    public function edit(News $news): View
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news-images', 'public');
        }

        $news->update($validated);

        return redirect()->route('dashboard')->with('status', 'news-updated');
    }

    public function destroy(News $news): RedirectResponse
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();

        return redirect()->route('dashboard')->with('status', 'news-deleted');
    }
    
}
