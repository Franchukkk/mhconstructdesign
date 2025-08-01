{{-- resources/views/portfolio/index.blade.php --}}

@extends('layouts.app')

@section('content')
    <section class="portfolio wrapper">
        <div class="page-title-container">
            <h1>portfolio</h1>
            <p>Explore our curated portfolio of residential projects—each one a reflection of thoughtful design, expert craftsmanship, and inspired transformation. Discover what’s possible when vision meets precision.</p>
        </div>

        <div class="row product-card g-3">
            @if($projects->count() > 0)
                @foreach($projects as $project)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <a href="{{ route('portfolio.show', $project->slug) }}">
                            <img src="{{ asset('storage/' . $project->hero_image) }}" alt="{{ $project->title }}">
                            <a href="{{ route('portfolio.show', $project->slug) }}">{{ $project->title }}</a>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p>No projects available at the moment...</p>
                </div>
            @endif
        </div>

        <div class="pagination">
            {{ $projects->links('vendor.pagination.numbers-only') }}
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
                <img src="{{ asset("images/get-involved-img.webp") }}" alt="">
            </div>
        </div>
    </section>
@endsection