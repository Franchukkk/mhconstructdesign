@extends('admin.layout')

@section('content')
    <style>
        .admin-container {
            padding: 20px;
            background-color: #f8f9fa;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 8px 12px;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .text-danger {
            font-size: 14px;
            margin-top: 5px;
        }
        .gallery-item {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
        }
        img {
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h3 {
            color: #495057;
            margin: 20px 0;
            font-size: 20px;
        }
    </style>

    <div class="admin-container">
        <h1>Редагувати проєкт: {{ $project->title }}</h1>

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Заголовок -->
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" 
                    value="{{ old('title', $project->title) }}" required>
                @error('title')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Опис -->
            <div class="mb-3">
                <label for="description" class="form-label">Опис</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $project->description) }}</textarea>
                @error('description')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Hero Image -->
            <div class="mb-3">
                <label for="hero_image" class="form-label">Головне зображення (Hero Image)</label>
                @if ($project->hero_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $project->hero_image) }}" alt="Hero Image" style="max-width: 300px;">
                    </div>
                @endif
                <input type="file" name="hero_image" id="hero_image" class="form-control" accept="image/*">
                @error('hero_image')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Інші поля -->
            <div class="mb-3">
                <label for="area" class="form-label">Площа</label>
                <input type="text" name="area" id="area" class="form-control" value="{{ old('area', $project->area) }}">
                @error('area')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="implementation_time" class="form-label">Час реалізації</label>
                <input type="text" name="implementation_time" id="implementation_time" class="form-control" value="{{ old('implementation_time', $project->implementation_time) }}">
                @error('implementation_time')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="design_time" class="form-label">Час розробки проекту</label>
                <input type="text" name="design_time" id="design_time" class="form-control" value="{{ old('design_time', $project->design_time) }}">
                @error('design_time')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="style" class="form-label">Стиль</label>
                <input type="text" name="style" id="style" class="form-control" value="{{ old('style', $project->style) }}">
                @error('style')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Адреса</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $project->location) }}">
                @error('location')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Галерея рендер/реальне фото -->
            <h3>Галерея (рендер / реальне фото)</h3>

            <div id="gallery-container">
                @foreach(old('gallery', $project->galleryItems->toArray()) as $index => $item)
                    <div class="gallery-item mb-4" data-index="{{ $index }}">
                        <label>Рендер (design_image)</label>
                        @if(!empty($item['design_image']) && !str_starts_with($item['design_image'], 'data:'))
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $item['design_image']) }}" alt="Render Image" style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" name="gallery[{{ $index }}][design_image]" accept="image/*" class="form-control mb-2">

                        <label>Реальне фото (real_image)</label>
                        @if(!empty($item['real_image']) && !str_starts_with($item['real_image'], 'data:'))
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $item['real_image']) }}" alt="Real Image" style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" name="gallery[{{ $index }}][real_image]" accept="image/*" class="form-control mb-2">

                        <label>Опис</label>
                        <textarea name="gallery[{{ $index }}][description]" class="form-control">{{ old("gallery.$index.description", $item['description'] ?? '') }}</textarea>

                        <button type="button" class="btn btn-danger mt-2 remove-gallery-item">Видалити</button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-gallery-item" class="btn btn-info mb-3">Додати новий елемент галереї</button>
            <br>
            <button type="submit" class="btn btn-primary">Зберегти</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Відмінити</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let galleryContainer = document.getElementById('gallery-container');
            let addBtn = document.getElementById('add-gallery-item');

            addBtn.addEventListener('click', function () {
                let index = galleryContainer.querySelectorAll('.gallery-item').length;
                let html = `
                    <div class="gallery-item mb-4" data-index="${index}">
                        <label>Рендер (design_image)</label>
                        <input type="file" name="gallery[${index}][design_image]" accept="image/*" class="form-control mb-2" required>

                        <label>Реальне фото (real_image)</label>
                        <input type="file" name="gallery[${index}][real_image]" accept="image/*" class="form-control mb-2" required>

                        <label>Опис</label>
                        <textarea name="gallery[${index}][description]" class="form-control"></textarea>

                        <button type="button" class="btn btn-danger mt-2 remove-gallery-item">Видалити</button>
                    </div>
                `;
                galleryContainer.insertAdjacentHTML('beforeend', html);
            });

            galleryContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-gallery-item')) {
                    e.target.closest('.gallery-item').remove();
                }
            });
        });
    </script>
@endsection
