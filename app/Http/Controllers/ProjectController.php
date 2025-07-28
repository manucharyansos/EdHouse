<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectsCategories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::with(['categories', 'images'])->get();
        $categories = ProjectsCategories::all();
        return Inertia::render('admin/projects/index', [
            'projects' => $projects,
            'categories' => $categories,
        ]);
    }

    public function create(): Response
    {
        $categories = ProjectsCategories::all();
        return Inertia::render('admin/projects/Create', ['categories' => $categories]);
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

        $projectData = $request->only(['name', 'description', 'location', 'architect']);

        if ($request->hasFile('image')) {
            $projectData['image'] = $request->file('image')->store('projects', 'public');
        }

        $project = Project::create($projectData);
        $project->categories()->sync($request->category_ids ?? []);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('project_images', 'public');
                $project->images()->create(['url' => $path]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Նախագիծը հաջողությամբ ավելացվել է');
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'architect' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:projects_categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'architect' => $request->architect,
        ]);

        if ($request->hasFile('image')) {
            $mainFile = $request->file('image');
            $project->image_data = base64_encode(file_get_contents($mainFile->path()));
            $project->image_type = $mainFile->getClientOriginalExtension();
            $project->save();
        }

        $project->categories()->sync($request->category_ids ?? []);

        // Հեռացնել հները
        foreach ($project->images as $img) {
            $img->delete();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $project->images()->create([
                    'image_data' => base64_encode(file_get_contents($image->path())),
                    'image_type' => $image->getClientOriginalExtension()
                ]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Նախագիծը թարմացվել է');
    }


    public function edit(Project $project): Response
    {
        $project->load(['categories', 'images']);
        $categories = ProjectsCategories::all();

        return Inertia::render('admin/projects/Edit', [
            'project' => $project,
            'categories' => $categories,
        ]);
    }

    public function show(Project $project): Response
    {
        $project->load(['categories', 'images']);
        $previous = Project::where('id', '<', $project->id)->orderBy('id', 'desc')->first();
        $next = Project::where('id', '>', $project->id)->orderBy('id', 'asc')->first();

        return Inertia::render('projects/Show', [
            'project' => [
                'id' => $project->id,
                'name' => $project->name,
                'description' => $project->description,
                'location' => $project->location,
                'architect' => $project->architect,
                'image_url' => $project->image_url,
                'images' => $project->images->map(fn ($image) => [
                    'id' => $image->id,
                    'url' => $image->image_url, // Օգտագործել image_url ատրիբուտը
                ]),
                'previousProject' => $previous ? ['id' => $previous->id] : null,
                'nextProject' => $next ? ['id' => $next->id] : null,
            ]
        ]);
    }


    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        return redirect()->route('projects.index');
    }
}
