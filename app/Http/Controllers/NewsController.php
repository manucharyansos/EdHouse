<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('News/Index', [
            'news' => News::latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('News/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
        ]);

        News::create($validated);

        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    public function edit(News $news): Response
    {
        return Inertia::render('News/Edit', [
            'news' => $news,
        ]);
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
        ]);

        $news->update($validated);

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
