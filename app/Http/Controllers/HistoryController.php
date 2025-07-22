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
     * Display the history section on About page.
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
     * Display the history section on About page.
     */
    public function adminIndex(): \Inertia\Response
    {
        $histories = History::orderBy('year')->get();

        return Inertia::render('admin/history/index', [
            'histories' => $histories,
        ]);
    }

    /**
     * Show the form for creating a new history item (admin only).
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('admin/history/Create');
    }

    /**
     * Store a newly created history item (admin only).
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $data = $request->only(['year', 'title', 'content', 'image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('history_images', 'public');
        }

        History::create($data);

        return redirect()->route('about')->with('success', 'History item created successfully.');
    }
    /**
     * Show the form for editing a history item (admin only).
     */
    public function edit(History $history): \Inertia\Response
    {
        return Inertia::render('admin/history/Edit', [
            'history' => $history,
        ]);
    }

    /**
     * Update the specified history item (admin only).
     */
    public function update(Request $request, History $history): RedirectResponse
    {
        $request->validate([
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($history->image) {
                Storage::disk('public')->delete($history->image);
            }
            $data['image'] = $request->file('image')->store('history_images', 'public');
        }

        $history->update($data);

        return redirect()->route('admin/history/index')->with('success', 'History item updated successfully.');
    }

    /**
     * Remove the specified history item (admin only).
     */
    public function destroy(History $history): RedirectResponse
    {
        if ($history->image) {
            Storage::disk('public')->delete($history->image);
        }

        $history->delete();

        return redirect()->route('about.index')->with('success', 'History item deleted successfully.');
    }
}
