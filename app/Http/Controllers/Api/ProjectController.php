<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:projects,title',
            'description' => 'nullable|string',
            'hero_image' => 'nullable|string',
            'area' => 'nullable|string|max:255',
            'implementation_time' => 'nullable|string|max:255',
            'design_time' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Якщо не передали meta_title - згенерувати
        if (empty($validated['meta_title'])) {
            $validated['meta_title'] = $validated['title'];
        }

        // Якщо не передали meta_description - згенерувати, обрізати опис до 160 символів
        if (empty($validated['meta_description']) && !empty($validated['description'])) {
            $validated['meta_description'] = Str::limit(strip_tags($validated['description']), 160);
        }

        $project = Project::create($validated);

        return new ProjectResource($project);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:projects,title,' . $project->id,
            'description' => 'nullable|string',
            'hero_image' => 'nullable|string',
            'area' => 'nullable|string|max:255',
            'implementation_time' => 'nullable|string|max:255',
            'design_time' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        if ($project->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if (empty($validated['meta_title'])) {
            $validated['meta_title'] = $validated['title'];
        }

        if (empty($validated['meta_description']) && !empty($validated['description'])) {
            $validated['meta_description'] = Str::limit(strip_tags($validated['description']), 160);
        }

        $project->update($validated);

        return new ProjectResource($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
