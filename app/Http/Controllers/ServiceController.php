<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Inertia\ResponseFactory;

class ServiceController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $services = Service::latest()->get();
        return inertia('services/index', ['services' => $services]);
    }

    public function adminIndex(): Response|ResponseFactory
    {
        $services = Service::latest()->get();
        return inertia('admin/services/index', ['services' => $services]);
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('admin/services/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'architect' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:projects_categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Գլխավոր նկարը՝ base64
        $mainFile = $request->file('image');
        $mainImageData = base64_encode(file_get_contents($mainFile->path()));
        $mainImageType = $mainFile->getClientOriginalExtension();

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'architect' => $request->architect,
            'image_data' => $mainImageData,
            'image_type' => $mainImageType,
        ]);

        $project->categories()->sync($request->category_ids ?? []);

        // Լրացուցիչ նկարներ
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $extraData = base64_encode(file_get_contents($image->path()));
                $extraType = $image->getClientOriginalExtension();

                $project->images()->create([
                    'image_data' => $extraData,
                    'image_type' => $extraType
                ]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Նախագիծը հաջողությամբ ավելացվել է');
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $service = Service::findOrFail($id);
        $data = $request->only(['name', 'description']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image_data'] = base64_encode(file_get_contents($file->path()));
            $data['image_type'] = $file->getClientOriginalExtension();
        }

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Ծառայությունը թարմացվել է');
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

    public function destroy($service): RedirectResponse
    {
        $service = Service::findOrFail($service);
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Ծառայությունը ջնջվել է');
    }
}
