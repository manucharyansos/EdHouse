<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HistoryController extends Controller
{
    /**
     * Show history section on public About page.
     */
    public function index(): \Inertia\Response
    {
        $histories = History::orderBy('year')->get();
        $timeline = $histories->pluck('year')->unique()->sort()->values();

        $sections = $histories->groupBy('title')->map(function ($items) {
            return $items->map->only(['id', 'year', 'title', 'content', 'image_url']);
        });

        return Inertia::render('about/index', [
            'timeline' => $timeline,
            'sections' => $sections,
        ]);
    }

    /**
     * Admin index.
     */
    public function adminIndex(): \Inertia\Response
    {
        $histories = History::orderBy('year')->get();

        return Inertia::render('admin/history/index', [
            'histories' => $histories,
        ]);
    }

    /**
     * Show create form.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('admin/history/Create');
    }

    /**
     * Store new history.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('history_images', 'public');
        }

        History::create($validated);

        return redirect()->route('admin.history.index')->with('success', 'Պատմությունը ավելացվեց։');
    }

    /**
     * Show edit form.
     */
    public function edit(History $history): \Inertia\Response
    {
        return Inertia::render('admin/history/Edit', [
            'history' => $history,
        ]);
    }

    /**
     * Update history.
     */
    public function update(Request $request, History $history): RedirectResponse
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($history->image) {
                Storage::disk('public')->delete($history->image);
            }
            $validated['image'] = $request->file('image')->store('history_images', 'public');
        }

        $history->update($validated);

        return redirect()->route('admin.history.index')->with('success', 'Պատմությունը թարմացվեց։');
    }

    /**
     * Delete.
     */
    public function destroy(History $history): RedirectResponse
    {
        if ($history->image) {
            Storage::disk('public')->delete($history->image);
        }

        $history->delete();

        return redirect()->route('admin.history.index')->with('success', 'Պատմությունը ջնջվեց։');
    }
}
