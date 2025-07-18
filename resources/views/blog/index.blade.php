@extends('layouts.app')

@section('content')
  <h1>Our Journal</h1>
  <p>Insights, tips, and behind-the-scenes stories from the world of interior design and construction.</p>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($posts as $post)
      <div class="card">
        <a href="{{ route('blog.show', $post->slug) }}">
          <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
          <h2>{{ $post->title }}</h2>
          <p>{{ $post->preview_text }}</p>
          <span>Read more →</span>
        </a>
      </div>
    @endforeach
  </div>

  {{ $posts->links() }} {{-- Пагінація --}}
@endsection
