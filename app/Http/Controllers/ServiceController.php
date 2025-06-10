<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return inertia('services/index', ['services' => $services]);
    }

    public function adminIndex()
    {
        $services = Service::all();
        return inertia('admin/services/index', ['services' => $services]);
    }

    public function create()
    {
        return inertia('admin/services/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'svg' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $data = $request->only(['svg', 'name', 'description']);

        if ($request->hasFile('svg')) {
            $data['svg'] = $request->file('svg')->store('services_svg', 'public');
        }

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Ծառայությունը ավելացվել է');
    }

    public function show(Service $service)
    {
        return inertia('services/Show', [
            'service' => $service
        ]);
    }

    public function edit($service)
    {
        $service = Service::findOrFail($service);
        return inertia('admin/services/Edit', ['service' => $service]);
    }

    public function update(Request $request, $service)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'svg' => 'nullable|file|mimes:jpeg,png,jpg,svg,image/svg+xml|max:2048',
        ]);

        if ($request->hasFile('svg')) {
            $validated['svg'] = $request->file('svg')->store('services_svg', 'public');
        }

        $service = Service::findOrFail($service);
        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Ծառայությունը թարմացվել է');
    }

    public function destroy($service)
    {
        $service = Service::findOrFail($service);
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Ծառայությունը ջնջվել է');
    }
}
