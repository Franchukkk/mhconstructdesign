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
                    'design_image' => $designPath ?? '',
                    'real_image' => $realPath ?? '',
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
        'hero_image' => 'nullable|image|max:2048',
        'area' => 'nullable|string|max:255',
        'implementation_time' => 'nullable|string|max:255',
        'design_time' => 'nullable|string|max:255',
        'style' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'gallery' => 'nullable|array',
        'gallery.*.id' => 'nullable|integer',
        'gallery.*.design_image' => 'nullable|image|max:2048',
        'gallery.*.real_image' => 'nullable|image|max:2048',
        'gallery.*.description' => 'nullable|string|max:1000',
        'gallery.*.old_design_image' => 'nullable|string',
        'gallery.*.old_real_image' => 'nullable|string',
    ]);

    // Оновлення основних полів проекту
    $project->title = $validatedData['title'];
    $project->description = $validatedData['description'] ?? null;
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

    $project->save();

    $incomingGallery = $validatedData['gallery'] ?? [];

    // Збираємо всі id з incoming даних, щоб видалити неіснуючі
    $incomingIds = collect($incomingGallery)->pluck('id')->filter()->all();

    // Видаляємо старі галерейні елементи, яких немає у нових даних
    $project->galleryItems()->whereNotIn('id', $incomingIds)->delete();

    foreach ($incomingGallery as $item) {
        $designPath = null;
        $realPath = null;

        // Якщо завантажено новий файл для design_image
        if (isset($item['design_image']) && $item['design_image'] instanceof \Illuminate\Http\UploadedFile) {
            $designPath = $item['design_image']->store('projects/gallery/design', 'public');
        } else {
            // Якщо файл не завантажений — залишаємо старий шлях (якщо є)
            $designPath = $item['old_design_image'] ?? null;
        }

        // Аналогічно для real_image
        if (isset($item['real_image']) && $item['real_image'] instanceof \Illuminate\Http\UploadedFile) {
            $realPath = $item['real_image']->store('projects/gallery/real', 'public');
        } else {
            $realPath = $item['old_real_image'] ?? null;
        }

        // Пропускаємо пусті записи без зображень і опису
        if (!$designPath && !$realPath && empty($item['description'])) {
            continue;
        }

        if (!empty($item['id'])) {
            // Оновлюємо існуючий елемент
            $galleryItem = $project->galleryItems()->find($item['id']);
            if ($galleryItem) {
                $galleryItem->update([
                    'design_image' => $designPath ?? '',
                    'real_image' => $realPath ?? '',
                    'description' => $item['description'] ?? null,
                ]);
            }
        } else {
            // Створюємо новий елемент галереї
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
