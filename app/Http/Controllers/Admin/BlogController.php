<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(Response::HTTP_FORBIDDEN, 'Access denied');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $posts = BlogPost::orderByDesc('created_at')->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $this->checkAdmin();
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:5048',
            'body' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);
        

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog_images', 'public');
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog.create')->with('success', 'Стаття створена!');
    }

    public function edit(BlogPost $post)
    {
        $this->checkAdmin();
        return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $this->checkAdmin();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:5048',
            'body' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);
        

        if ($request->hasFile('image')) {
            // Видалити стару картинку
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request->file('image')->store('blog_images', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.blog.edit', $post)->with('success', 'Стаття оновлена!');
    }


    public function uploadImage(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Прибираємо всі символи, крім латиниці, цифр, дефісу, підкреслення та крапки
            $safeName = preg_replace('/[^A-Za-z0-9\-_\.]/', '', $file->getClientOriginalName());

            // Додаємо timestamp, щоб уникнути колізій імен
            $filename = time() . '_' . $safeName;

            // Зберігаємо файл у потрібну папку
            $path = $file->storeAs('blog_body_images', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
                'uploaded' => 1,
                'fileName' => $filename,
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function destroy(BlogPost $post)
    {
        // Витягуємо зображення з HTML-контенту
        preg_match_all('/<img[^>]+src="([^">]+)"/', $post->body, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $imageUrl) {
                // Приводимо URL до шляху у файловій системі
                $path = str_replace('/storage/', '', parse_url($imageUrl, PHP_URL_PATH));

                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $post->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Стаття видалена разом із зображеннями.');
    }

}