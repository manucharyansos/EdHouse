<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{
//    public function index(): Response
//    {
//        return Inertia::render('news/index', [
//            'news' => News::latest()->get(),
//        ]);
//    }

    public function adminIndex(): Response
    {
        return Inertia::render('admin/news/index', [
            'news' => News::latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/news/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Նորությունը ավելացվել է։');
    }

    public function edit(News $news): Response
    {
        return Inertia::render('admin/news/Edit', [
            'news' => $news,
        ]);
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Նորությունը թարմացվել է։');
    }

    public function destroy(News $news): RedirectResponse
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Նորությունը ջնջվել է։');
    }
}
