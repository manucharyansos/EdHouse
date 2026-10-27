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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $validated['image_data'] = base64_encode(file_get_contents($imageFile->path()));
            $validated['image_type'] = $imageFile->getClientOriginalExtension();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $validated['image_data'] = base64_encode(file_get_contents($imageFile->path()));
            $validated['image_type'] = $imageFile->getClientOriginalExtension();
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Նորությունը թարմացվել է։');
    }


    public function destroy(News $news): RedirectResponse
    {
        if ($news->image) {
            $path = str_replace('/storage/', '', $news->image);
            Storage::disk('public')->delete($path);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Նորությունը ջնջվել է։');
    }
}
