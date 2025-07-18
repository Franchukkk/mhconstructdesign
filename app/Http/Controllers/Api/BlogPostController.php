<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        return BlogPost::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(6);
    }

    public function show($slug)
    {
        return BlogPost::where('slug', $slug)
            ->whereNotNull('published_at')
            ->firstOrFail();
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        // Автоматично згенеруємо slug, якщо не переданий
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post = BlogPost::create($validated);

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $validated = $this->validateData($request, $post->id);

        $post->update($validated);

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Стаття видалена']);
    }

    private function validateData(Request $request, $id = null)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_posts,slug,' . $id,
            'image' => 'nullable|string',
            'preview_text' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);
    }
}
