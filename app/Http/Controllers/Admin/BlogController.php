<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // <-- додати для роботи з файлами

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderByDesc('created_at')->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('image')) {
            // Збереження файлу в папку storage/app/public/blog_images
            $validated['image'] = $request->file('image')->store('blog_images', 'public');
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post = BlogPost::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Стаття створена');
    }

    public function edit(BlogPost $post)
    {
        return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $validated = $this->validateData($request, $post->id);

        if ($request->hasFile('image')) {
            // Опційно видалити старе зображення
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $validated['image'] = $request->file('image')->store('blog_images', 'public');
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Стаття оновлена');
    }

    public function destroy(BlogPost $post)
    {
        // Опційно видалити файл при видаленні посту
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Статтю видалено');
    }

    private function validateData(Request $request, $id = null)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_posts,slug,' . $id,
            'image' => 'nullable|file|image|max:2048',
            'preview_text' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);
    }
}
