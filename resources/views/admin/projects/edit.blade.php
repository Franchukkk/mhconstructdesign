@extends('admin.layout')

@section('content')
    <style>
        .form-label {
            font-weight: 600;
            color: #333;
            font-size: 16.8rem;
            /* 14 *1.2 = 16.8px */
            margin-bottom: 7.2rem;
            /* 6 *1.2 = 7.2px */
            display: inline-block;
        }

        .form-control {
            border-radius: 4.8rem;
            /* 4 *1.2 = 4.8px */
            border: 1.2rem solid #ddd;
            /* 1 *1.2 = 1.2px */
            padding: 9.6rem 14.4rem;
            /* 8*1.2=9.6px, 12*1.2=14.4px */
            font-size: 16.8rem;
            /* 14 *1.2 = 16.8px */
            line-height: 1.5;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 2.4rem rgba(0, 123, 255, 0.25);
            /* 2rem *1.2=2.4px */
            outline: none;
        }

        .text-danger {
            font-size: 14.4rem;
            /* 12 *1.2 = 14.4px */
            margin-top: 4.8rem;
            /* 4 *1.2 = 4.8px */
            color: #dc3545;
        }

        .btn {
            padding: 9.6rem 19.2rem;
            /* 8*1.2=9.6px, 16*1.2=19.2px */
            border-radius: 4.8rem;
            /* 4 *1.2 =4.8px */
            font-weight: 500;
            font-size: 16.8rem;
            /* 14 *1.2 =16.8px */
            cursor: pointer;
            border: 1.2rem solid transparent;
            /* 1 *1.2=1.2px */
            transition: background-color 0.2s ease, border-color 0.2s ease;
            display: inline-block;
            text-align: center;
            user-select: none;
            line-height: 1.5;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .gallery-pair {
            background-color: #f8f9fa;
            border-radius: 4.8rem;
            /* 4 *1.2=4.8px */
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 18rem;
            /* 15 *1.2=18px */
            font-size: 28.8rem;
            /* 24 *1.2=28.8px */
        }

        h3 {
            color: #2c3e50;
            margin-bottom: 12rem;
            /* 10 *1.2=12px */
            font-size: 21.6rem;
            /* 18 *1.2=21.6px */
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
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $project->title) }}" required>
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
                        <input type="hidden" name="gallery[{{ $index }}][old_design_image]" value="{{ $item['design_image'] ?? '' }}">

                        <label>Реальне фото (real_image)</label>
                        @if(!empty($item['real_image']) && !str_starts_with($item['real_image'], 'data:'))
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $item['real_image']) }}" alt="Real Image" style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" name="gallery[{{ $index }}][real_image]" accept="image/*" class="form-control mb-2">
                        <input type="hidden" name="gallery[{{ $index }}][old_real_image]" value="{{ $item['real_image'] ?? '' }}">

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
