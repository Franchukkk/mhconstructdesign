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
            <input type="text" name="implementation_time" id="implementation_time" class="form-control"
                value="{{ old('implementation_time') }}">
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

                            <label class="form-label">Опис (опціонально):</label>
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