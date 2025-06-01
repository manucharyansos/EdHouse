<?php

namespace App\Http\Controllers;

use App\Models\BackgroundImage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class BackgroundImageController extends Controller
{
    public function index(): \Inertia\Response
    {
        $images = BackgroundImage::all();
        return Inertia::render('BackgroundImages/Index', [
            'images' => $images,
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('BackgroundImages/Create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2MB max
        ]);

        $path = $request->file('image')->store('images', 'public');

        BackgroundImage::create([
            'image_url' => '/storage/' . $path,
        ]);

        return redirect()->route('background-images.index')->with('success', 'Image uploaded successfully.');
    }

    public function edit(BackgroundImage $backgroundImage): \Inertia\Response
    {
        return Inertia::render('BackgroundImages/Edit', [
            'image' => $backgroundImage,
        ]);
    }

    public function update(Request $request, BackgroundImage $backgroundImage): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete(str_replace('/storage/', '', $backgroundImage->image_url));
            $path = $request->file('image')->store('images', 'public');
            $backgroundImage->image_url = '/storage/' . $path;
            $backgroundImage->save();
        }

        return redirect()->route('background-images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(BackgroundImage $backgroundImage): \Illuminate\Http\RedirectResponse
    {
        Storage::disk('public')->delete(str_replace('/storage/', '', $backgroundImage->image_url));
        $backgroundImage->delete();
        return redirect()->route('background-images.index')->with('success', 'Image deleted successfully.');
    }
}
