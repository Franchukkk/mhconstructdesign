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
            'design_description' => 'nullable|string',
            'realization_description' => 'nullable|string',
            'hero_image' => 'nullable|image|max:20048',
            'portfolio_cover' => 'nullable|image|max:20048',
            'area' => 'nullable|string|max:255',
            'implementation_time' => 'nullable|string|max:255',
            'design_time' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',

            'gallery' => 'nullable|array',
            'gallery.*.design_image' => 'nullable|image|max:20048',
            'gallery.*.real_image' => 'nullable|image|max:20048',
            'gallery.*.description' => 'nullable|string',
            'portfolio_project_page_cover' => 'nullable|image|max:20048',

        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if (empty($validated['meta_title'])) {
            $validated['meta_title'] = $validated['title'];
        }
        if (empty($validated['meta_description']) && !empty($validated['description'])) {
            $validated['meta_description'] = Str::limit(strip_tags($validated['description']), 160);
        }

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('projects/hero_images', 'public');
        }

        if ($request->hasFile('portfolio_cover')) {
            $validated['portfolio_cover'] = $request->file('portfolio_cover')->store('projects/portfolio_covers', 'public');
        }


        if ($request->hasFile('portfolio_project_page_cover')) {
            $validated['portfolio_project_page_cover'] = $request->file('portfolio_project_page_cover')->store('projects/extra_images', 'public');
        }

        $project = Project::create($validated);

        if (!empty($validated['gallery'])) {
            foreach ($validated['gallery'] as $item) {
                $designFile = $item['design_image'] ?? null;
                $realFile = $item['real_image'] ?? null;

                if (!$designFile && !$realFile && empty($item['description'])) {
                    continue;
                }

                $designPath = $designFile ? $designFile->store('projects/gallery/design', 'public') : '';
                $realPath = $realFile ? $realFile->store('projects/gallery/real', 'public') : '';

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
        $project->load('galleryItems');
        // Не сортуємо, або сортуємо за order, якщо є

        return view('admin.projects.edit', [
            'project' => $project,
            'gallery' => $project->galleryItems,
        ]);
    }




    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'design_description' => 'nullable|string',
            'realization_description' => 'nullable|string',
            'hero_image' => 'nullable|image|max:20048',
            'portfolio_cover' => 'nullable|image|max:20048',
            'area' => 'nullable|string|max:255',
            'implementation_time' => 'nullable|string|max:255',
            'design_time' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'gallery' => 'nullable|array',
            'gallery.*.id' => 'nullable|integer',
            'gallery.*.design_image' => 'nullable|image|max:20048',
            'gallery.*.real_image' => 'nullable|image|max:20048',
            'gallery.*.description' => 'nullable|string|max:1000',
            'gallery.*.old_design_image' => 'nullable|string',
            'gallery.*.old_real_image' => 'nullable|string',
            'portfolio_project_page_cover' => 'nullable|image|max:20048',

        ]);


        // Оновлення основних полів проекту
        $project->title = $validatedData['title'];
        $project->description = $validatedData['description'] ?? null;
        $project->design_description = $validatedData['design_description'] ?? null;
        $project->realization_description = $validatedData['realization_description'] ?? null;

        $project->area = $validatedData['area'] ?? null;
        $project->implementation_time = $validatedData['implementation_time'] ?? null;
        $project->design_time = $validatedData['design_time'] ?? null;
        $project->style = $validatedData['style'] ?? null;
        $project->location = $validatedData['location'] ?? null;

        if ($request->hasFile('hero_image')) {
            // Опціонально: можна видалити старе зображення, якщо потрібно
            // Storage::disk('public')->delete($project->hero_image);
            $project->hero_image = $request->file('hero_image')->store('projects/hero_images', 'public');
        }

        if ($request->hasFile('portfolio_cover')) {
            // При бажанні, видалити старий файл:
            // Storage::disk('public')->delete($project->portfolio_cover);

            $project->portfolio_cover = $request->file('portfolio_cover')->store('projects/portfolio_covers', 'public');
        }

        if ($request->hasFile('portfolio_project_page_cover')) {
            // Опційно видалити старий файл:
            // Storage::disk('public')->delete($project->portfolio_project_page_cover);

            $project->portfolio_project_page_cover = $request->file('portfolio_project_page_cover')->store('projects/extra_images', 'public');
        }



        $project->meta_title = $validatedData['meta_title'] ?? $project->title;

        if (!empty($validatedData['meta_description'])) {
            $project->meta_description = $validatedData['meta_description'];
        } elseif (!empty($validatedData['description'])) {
            $project->meta_description = Str::limit(strip_tags($validatedData['description']), 160);
        }


        $project->save();

        $incomingGallery = $validatedData['gallery'] ?? [];

        // Збираємо всі id з incoming даних, щоб видалити неіснуючі
        $incomingIds = collect($incomingGallery)->pluck('id')->filter()->all();

        // Видаляємо старі галерейні елементи, яких немає у нових даних
        $project->galleryItems()->whereNotIn('id', $incomingIds)->delete();

        foreach ($incomingGallery as $item) {
            $designPath = $item['old_design_image'] ?? null;
            $realPath = $item['old_real_image'] ?? null;

            if (isset($item['design_image']) && $item['design_image'] instanceof \Illuminate\Http\UploadedFile) {
                $designPath = $item['design_image']->store('projects/gallery/design', 'public');
            }

            if (isset($item['real_image']) && $item['real_image'] instanceof \Illuminate\Http\UploadedFile) {
                $realPath = $item['real_image']->store('projects/gallery/real', 'public');
            }

            // ⛔ Пропускаємо пусті (нічого немає)
            if (!$designPath && !$realPath && empty($item['description'])) {
                continue;
            }

            if (!empty($item['id'])) {
                $galleryItem = $project->galleryItems()->find($item['id']);
                if ($galleryItem) {
                    $galleryItem->update([
                        'design_image' => $designPath ?? '',
                        'real_image' => $realPath ?? '',
                        'description' => $item['description'] ?? null,
                    ]);
                }
            } else {
                $project->galleryItems()->create([
                    'design_image' => $designPath ?? '',
                    'real_image' => $realPath ?? '',
                    'description' => $item['description'] ?? null,
                ]);
            }
        }


        return redirect()->route('admin.projects.index')->with('success', 'Проєкт успішно оновлено!');
    }







    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Проект видалено');
    }
}
