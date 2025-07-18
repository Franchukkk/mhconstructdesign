@extends('layouts.app')

@section('content')
    <h1>{{ $project->title }}</h1>

    <img src="{{ $project->hero_image }}" alt="{{ $project->title }}" style="max-width: 600px;">

    <p>{{ $project->description }}</p>

    <ul>
        <li><strong>Площа:</strong> {{ $project->area }}</li>
        <li><strong>Реалізація:</strong> {{ $project->implementation_time }}</li>
        <li><strong>Розробка:</strong> {{ $project->design_time }}</li>
        <li><strong>Стиль:</strong> {{ $project->style }}</li>
        <li><strong>Адрес:</strong> {{ $project->location }}</li>
    </ul>

    <hr>

    <h2>Design vs Reality</h2>

    @foreach($project->galleryItems as $item)
        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div>
                <img src="{{ $item->design_image }}" alt="Design" style="width: 100%; max-width: 300px;">
                <p>Дизайн</p>
            </div>
            <div>
                <img src="{{ $item->real_image }}" alt="Reality" style="width: 100%; max-width: 300px;">
                <p>Реалізація</p>
            </div>
        </div>
        <p>{{ $item->description }}</p>
        <hr>
    @endforeach

@endsection
