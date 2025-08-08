@extends('layouts.app')

@section('content')
  <section class="blog wrapper">
    <div class="page-title-container">
    <h1>blog</h1>
    <p>Here we write our art articles — insights, tips, and behind-the-scenes stories from the world of
      interior design and construction.</p>
    </div>

    <div class="row product-card g-3">
    @if($posts->count() > 0)
      @foreach($posts as $post)
      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
      <a href="{{ route('blog.show', $post->slug) }}">
      <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
      </a>
      <strong>{{ $post->title }}</strong>
      <p>{{ $post->preview_heading }}</p>
      <a href="{{ route('blog.show', $post->slug) }}">read this</a>
      </div>
      @endforeach
    @else
    <div class="col-12 text-center">
      <p>No articles available at the moment...</p>
    </div>
    @endif
    </div>

    <div class="pagination">
    {{ $posts->links('vendor.pagination.numbers-only') }}
    </div>

  </section>
  <section class="get-involved wrapper">
    <div class="row items-center g-5">
    <div class="col-12 col-md-4 col-lg-4">
      <h2>Get Involved</h2>
      <p>Our talented squad is eager to make your dream space a reality.
      Don’t wait — let’s start making magic together!</p>
      <a class="button-primary" href="{{ route("contact-request.form") }}">Get in Touch</a>
    </div>
    <div class="col-12 col-md-8 col-lg-8">
      <img src="{{ asset("images/get-involved-img.webp") }}" alt="Team of designers ready to turn your vision into reality — join the creative journey with M&H Construct and Design." loading="lazy">
    </div>
    </div>
  </section>
@endsection