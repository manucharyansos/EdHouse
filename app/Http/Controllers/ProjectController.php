<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectsCategories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::with(['categories', 'images'])->get();
        $categories = ProjectsCategories::all();
        return Inertia::render('projects/Index', [
            'projects' => $projects,
            'categories' => $categories,
        ]);
    }

    public function create(): Response
    {
        $categories = ProjectsCategories::all();
        return Inertia::render('projects/Create', ['categories' => $categories]);
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
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project = Project::create($validated);
        $project->categories()->sync($request->category_ids ?? []);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('project_images', 'public');
                $project->images()->create(['url' => $path]);
            }
        }

        return redirect()->route('projects.index');
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'architect' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:projects_categories,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) {
                \Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);
        $project->categories()->sync($request->category_ids ?? []);
        if ($request->hasFile('images')) {
            foreach ($project->images as $image) {
                \Storage::disk('public')->delete($image->url);
            }
            $project->images()->delete();
            foreach ($request->file('images') as $image) {
                $path = $image->store('project_images', 'public');
                $project->images()->create(['url' => $path]);
            }
        }

        return redirect()->route('projects.index');
    }

    public function edit(Project $project): Response
    {
        $project->load(['categories', 'images']);
        $categories = ProjectsCategories::all();
        return Inertia::render('projects/Edit', [
            'project' => $project,
            'categories' => $categories,
        ]);
    }

    public function show(Project $project): Response
    {
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
                    'image_url' => $image->image_url,
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
