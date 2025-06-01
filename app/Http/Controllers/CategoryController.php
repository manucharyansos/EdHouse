<?php

namespace App\Http\Controllers;

use App\Models\ProjectsCategories;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectsCategories::all();
        return Inertia::render('Categories/Index', ['categories' => $categories]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        ProjectsCategories::create($request->all());
        return redirect()->route('categories.index');
    }

    public function edit(ProjectsCategories $category): Response
    {
        return Inertia::render('Categories/Edit', ['category' => $category]);
    }

    public function update(Request $request, ProjectsCategories $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function destroy(ProjectsCategories $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
