<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Inertia\ResponseFactory;

class ServiceController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $services = Service::all();
        return inertia('services/index', ['services' => $services]);
    }

    public function adminIndex(): Response|ResponseFactory
    {
        $services = Service::all();
        return inertia('admin/services/index', ['services' => $services]);
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('admin/services/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $imageData = null;
        if ($request->hasFile('image')) {
            $imageData = base64_encode(file_get_contents($request->file('image')->path()));
        }

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_data' => $imageData
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Ծառայությունը ավելացվել է');
    }

    public function show(Service $service): Response|ResponseFactory
    {
        $projects = Project::get();
        return inertia('services/Show', [
            'service' => $service,
            'projects' => $projects
        ]);
    }

    public function edit($service): Response|ResponseFactory
    {
        $service = Service::findOrFail($service);
        return inertia('admin/services/Edit', ['service' => $service]);
    }

    public function update(Request $request, $service)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $service = Service::findOrFail($service);
        $data = $request->only(['name', 'description']);

        if ($request->hasFile('image')) {
            $data['image_data'] = base64_encode(file_get_contents($request->file('image')->path()));
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Ծառայությունը թարմացվել է');
    }

    public function destroy($service): \Illuminate\Http\RedirectResponse
    {
        $service = Service::findOrFail($service);
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Ծառայությունը ջնջվել է');
    }
}
