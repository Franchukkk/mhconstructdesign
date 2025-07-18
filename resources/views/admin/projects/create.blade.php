@extends('admin.layout')

@section('content')
    <style>
        .form-label {
            font-weight: 600;
            color: #333;
        }
        
        .form-control {
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 8px 12px;
        }
        
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        
        .text-danger {
            font-size: 0.875rem;
            margin-top: 4px;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
        }
        
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        
        .gallery-pair {
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
        }
        
        h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }
    </style>

    <h1>Додати новий проєкт</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Заголовок -->
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!-- Опис -->
        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!-- Hero Image -->
        <div class="mb-3">
            <label for="hero_image" class="form-label">Головне зображення (Hero Image)</label>
            <input type="file" name="hero_image" id="hero_image" class="form-control" accept="image/*">
            @error('hero_image')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!-- Технічний блок -->
        <div class="mb-3">
            <label for="area" class="form-label">Площа</label>
            <input type="text" name="area" id="area" class="form-control" value="{{ old('area') }}">
            @error('area')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="implementation_time" class="form-label">Час реалізації</label>
            <input type="text" name="implementation_time" id="implementation_time" class="form-control" value="{{ old('implementation_time') }}">
            @error('implementation_time')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="design_time" class="form-label">Час розробки проекту</label>
            <input type="text" name="design_time" id="design_time" class="form-control" value="{{ old('design_time') }}">
            @error('design_time')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="style" class="form-label">Стиль</label>
            <input type="text" name="style" id="style" class="form-control" value="{{ old('style') }}">
            @error('style')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Адреса</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
            @error('location')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        

        <!-- Галерея -->
        <div id="gallery-container" class="mb-4">
            <h3>Галерея (Рендер / Реальне фото)</h3>

            <button type="button" id="add-gallery-item" class="btn btn-primary mb-3">Додати порівняння</button>

            <div id="gallery-items">
                {{-- Сюди JS додаватиме поля --}}
            </div>
        </div>

        <button type="submit" class="btn btn-success">Створити</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Відмінити</a>
    </form>

    <script>
        let galleryIndex = 0;

        document.getElementById('add-gallery-item').addEventListener('click', function () {
            const container = document.getElementById('gallery-items');
            const html = `
                <div class="gallery-pair mb-3 border p-3">
                    <label>Рендер (design_image):</label>
                    <input type="file" name="gallery[${galleryIndex}][design_image]" accept="image/*" required class="form-control mb-2">

                    <label>Реальне фото (real_image):</label>
                    <input type="file" name="gallery[${galleryIndex}][real_image]" accept="image/*" required class="form-control mb-2">

                    <label>Опис (опціонально):</label>
                    <textarea name="gallery[${galleryIndex}][description]" rows="2" class="form-control mb-2"></textarea>

                    <button type="button" class="btn btn-danger remove-gallery-item">Видалити</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            galleryIndex++;
        });

        document.getElementById('gallery-items').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-gallery-item')) {
                e.target.closest('.gallery-pair').remove();
            }
        });
    </script>
@endsection
