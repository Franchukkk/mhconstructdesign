{{-- resources/views/portfolio/index.blade.php --}}

@extends('layouts.app')

@section('content')
    <section class="portfolio-index container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Наше Портфоліо</h1>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($projects as $project)
                <a href="{{ route('portfolio.show', $project->slug) }}" class="block group border rounded overflow-hidden shadow hover:shadow-lg transition">
                    <div class="relative overflow-hidden">
                        @if($project->main_image)
                            <img 
                                src="{{ asset('storage/' . $project->main_image) }}" 
                                alt="{{ $project->title }}" 
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                            >
                        @else
                            <div class="bg-gray-200 h-48 flex items-center justify-center text-gray-500">
                                Немає зображення
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <h2 class="text-lg font-semibold">{{ $project->title }}</h2>
                        </div>
                    </div>

                    <div class="p-4">
                        <p class="text-gray-700 line-clamp-2">
                            {{ Str::limit(strip_tags($project->description), 100) }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $projects->links() }}
        </div>
    </section>
@endsection
