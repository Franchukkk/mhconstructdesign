<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::whereNotNull('created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(6); // або більше


        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->whereNotNull('created_at')
            ->firstOrFail();

        return view('blog.show', [
            'post' => $post,
            'meta_title' => $post->meta_title ?? $post->title,
            'meta_description' => $post->meta_description ?? Str::limit(strip_tags($post->body), 150),
            'og_title' => $post->title,
            'og_description' => $post->preview_text,
            'og_image' => asset('storage/' . $post->image),
        ]);
        
    }
}
