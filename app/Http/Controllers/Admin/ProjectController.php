<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:projects,title',
            'description' => 'nullable|string',
            'hero_image' => 'nullable|image|max:20048',
            'area' => 'nullable|string|max:255',
            'implementation_time' => 'nullable|string|max:255',
            'design_time' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',

            'gallery' => 'nullable|array',
            'gallery.*.design_image' => 'required_with:gallery.*|image|max:20048',
            'gallery.*.real_image' => 'required_with:gallery.*|image|max:20048',
            'gallery.*.description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if (empty($validated['meta_title'])) {
            $validated['meta_title'] = $validated['title'];
        }
        if (empty($validated['meta_description']) && !empty($validated['description'])) {
            $validated['meta_description'] = Str::limit(strip_tags($validated['description']), 160);
        }

        // Зберігаємо hero_image, якщо завантажено
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('projects/hero_images', 'public');
        }

        $project = Project::create($validated);

        // Зберігаємо галерею, якщо передана
        if ($request->has('gallery')) {
            foreach ($request->file('gallery') as $item) {
                $designPath = $item['design_image']->store('projects/gallery/design', 'public');
                $realPath = $item['real_image']->store('projects/gallery/real', 'public');

                $project->galleryItems()->create([
                    'design_image' => $designPath,
                    'real_image' => $realPath,
                    'description' => $item['description'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Проект створено');
    }

    public function edit(Project $project)
    {
        // Завантажуємо пов’язану галерею
        $project->load('galleryItems');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:projects,title,' . $project->id,
            'description' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',
            'area' => 'nullable|string|max:255',
            'implementation_time' => 'nullable|string|max:255',
            'design_time' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',

            'gallery' => 'nullable|array',
            'gallery.*.design_image' => 'nullable|image|max:2048',
            'gallery.*.real_image' => 'nullable|image|max:2048',
            'gallery.*.description' => 'nullable|string',
        ]);

        // Якщо змінився заголовок, оновлюємо slug
        if ($project->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if (empty($validated['meta_title'])) {
            $validated['meta_title'] = $validated['title'];
        }

        if (empty($validated['meta_description']) && !empty($validated['description'])) {
            $validated['meta_description'] = Str::limit(strip_tags($validated['description']), 160);
        }

        // Обробляємо нове головне зображення, якщо завантажено
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('projects/hero_images', 'public');
        }

        $project->update($validated);

        // Обробка галереї
        if ($request->has('gallery') && is_array($request->input('gallery'))) {
            foreach ($request->input('gallery') as $index => $galleryItem) {
                $designFile = $request->file("gallery.$index.design_image");
                $realFile = $request->file("gallery.$index.real_image");

                $designPath = $designFile ? $designFile->store('projects/gallery/design', 'public') : null;
                $realPath = $realFile ? $realFile->store('projects/gallery/real', 'public') : null;

                // Створюємо новий елемент галереї, якщо є хоч щось
                if ($designPath || $realPath || !empty($galleryItem['description'])) {
                    $project->galleryItems()->create([
                        'design_image' => $designPath,
                        'real_image' => $realPath,
                        'description' => $galleryItem['description'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Проект оновлено');
    }


    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Проект видалено');
    }
}
