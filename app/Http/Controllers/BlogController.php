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
            ->paginate(6);

        // Додамо для кожного поста поле preview_heading
        foreach ($posts as $post) {
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($post->body, 'HTML-ENTITIES', 'UTF-8'));
            libxml_clear_errors();

            $h2s = $dom->getElementsByTagName('h2');
            $post->preview_heading = $h2s->length > 0 ? trim($h2s->item(0)->textContent) : null;
        }

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
