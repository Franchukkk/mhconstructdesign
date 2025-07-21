@extends('admin.layout')

@section('content')
    {{-- === СТИЛІ === --}}
    <style>
        label {
            font-size: 16rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            font-size: 16.8rem;
            margin-bottom: 7.2rem;
            display: inline-block;
        }

        .form-control {
            border-radius: 4.8rem;
            border: 1.2rem solid #ddd;
            padding: 9.6rem 14.4rem;
            font-size: 16.8rem;
            line-height: 1.5;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 2.4rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .text-danger {
            font-size: 14.4rem;
            margin-top: 4.8rem;
            color: #dc3545;
        }

        .btn {
            padding: 9.6rem 19.2rem;
            border-radius: 4.8rem;
            font-weight: 500;
            font-size: 16.8rem;
            cursor: pointer;
            border: 1.2rem solid transparent;
            transition: background-color 0.2s ease, border-color 0.2s ease;
            display: inline-block;
            text-align: center;
            user-select: none;
            line-height: 1.5;
        }

        .btn-success { background-color: #28a745; border-color: #28a745; color: #fff; }
        .btn-success:hover { background-color: #218838; border-color: #1e7e34; }
        .btn-secondary { background-color: #6c757d; border-color: #6c757d; color: #fff; }
        .btn-secondary:hover { background-color: #5a6268; border-color: #545b62; }
        .btn-primary { background-color: #007bff; border-color: #007bff; color: #fff; }
        .btn-primary:hover { background-color: #0069d9; border-color: #0062cc; }
        .btn-danger { background-color: #dc3545; border-color: #dc3545; color: #fff; }
        .btn-danger:hover { background-color: #c82333; border-color: #bd2130; }

        h1 {
            color: #2c3e50;
            margin-bottom: 18rem;
            font-size: 28.8rem;
        }

        h3 {
            color: #2c3e50;
            margin-bottom: 12rem;
            font-size: 21.6rem;
        }

        .file-dropzone {
            width: 100%;
            border: 2.4rem dashed #ccc;
            padding: 36rem;
            text-align: center;
            border-radius: 12rem;
            cursor: pointer;
            transition: border-color 0.3s ease;
            background-color: #fafafa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .file-dropzone span {
            font-size: 16.8rem;
            color: #555;
            margin-top: 9.6rem;
        }

        .file-dropzone img {
            margin-top: 14.4rem;
            max-width: 100%;
            max-height: 192rem;
            border-radius: 8.4rem;
            object-fit: contain;
            box-shadow: 0 2.4rem 9.6rem rgba(0, 0, 0, 0.1);
        }

        .dropzone {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 150px;
            padding: 2rem;
            border: 2px dashed #ccc;
            border-radius: 10px;
            background-color: #fafafa;
            cursor: pointer;
            text-align: center;
        }

        .dropzone.dragover {
            border-color: #28a745;
            background-color: #e6ffed;
        }

        .dropzone-input {
            display: none;
        }

        .dropzone-text {
            color: #555;
            font-size: 14px;
        }

        .dropzones-flex {
            display: flex;
            gap: 20rem;
            flex-wrap: wrap;
        }

        .gallery-pair {
            background-color: #f8f9fa;
            border-radius: 4.8rem;
            padding: 12rem;
            margin-bottom: 13rem;
        }

        button[type="button"]:not(.navbar button), button[type="submit"], .btn-secondary  {
            width: 100%;
        }

        button[type="submit"] {
            margin-right: 10rem;
            margin-bottom: 5rem;
        }

        @media screen and (min-width: 480px) {
            .file-dropzone, .dropzone {
                max-width: 300px;
            }

            button[type="button"]:not(.navbar button), button[type="submit"], .btn-secondary  {
                width: auto;
                margin-right: 0;
                margin-bottom: 0;
            }

            
        }
    </style>

    {{-- === HTML ФОРМА === --}}
    <h1>Редагувати проєкт: {{ $project->title }}</h1>

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Заголовок --}}
        <div class="mb-3">
            <label class="form-label">Заголовок</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $project->title) }}" required>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        {{-- Опис --}}
        <div class="mb-3">
            <label class="form-label">Опис</label>
            <textarea name="description" class="form-control">{{ old('description', $project->description) }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        {{-- Hero Image --}}
        <div class="mb-3">
            <label class="form-label">Головне зображення (Hero Image)</label>
            <label for="hero_image" class="file-dropzone" id="dropzone">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-upload" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    width="38" height="38">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                </svg>
                <span class="dropzone-text">Перетягніть або натисніть для вибору зображення</span>
                <img id="preview-image" src="{{ $project->hero_image ? asset('storage/' . $project->hero_image) : '#' }}"
                    alt="Попередній перегляд" style="{{ $project->hero_image ? '' : 'display: none;' }}" />
                <input type="file" name="hero_image" id="hero_image" accept="image/*" hidden>
            </label>
            @error('hero_image')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        {{-- Інші поля --}}
        @foreach (['area' => 'Площа (м²)', 'implementation_time' => 'Час реалізації (міс)', 'design_time' => 'Час розробки', 'style' => 'Стиль', 'location' => 'Адреса'] as $field => $label)
            <div class="mb-3">
                <label class="form-label">{{ $label }}</label>
                <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field, $project->$field) }}">
                @error($field)<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        @endforeach

        {{-- Галерея --}}
        <h3>Галерея (Рендер / Реальне фото)</h3>
        <button type="button" id="add-gallery-item" class="btn btn-primary mb-3">Додати порівняння</button>

        <div id="gallery-items">
            @foreach(old('gallery', $project->galleryItems->toArray()) as $index => $item)
                <div class="gallery-pair">
                    <div class="dropzones-flex">
                        @foreach (['design_image' => 'Рендер', 'real_image' => 'Реальне фото'] as $input => $text)
                            <div>
                                <label>{{ $text }}</label>
                                <div class="dropzone mb-2" data-preview-id="{{ $input }}-preview-{{ $index }}">
                                    <div>
                                        <span class="dropzone-text">Перетягніть або натисніть для завантаження</span>
                                        @if(!empty($item[$input]))
                                            <img src="{{ asset('storage/' . $item[$input]) }}"
                                                id="{{ $input }}-preview-{{ $index }}" class="preview-image"
                                                style="max-width: 100%; border-radius: 8px;" />
                                        @else
                                            <img id="{{ $input }}-preview-{{ $index }}" class="preview-image"
                                                style="display: none; max-width: 100%; border-radius: 8px;" />
                                        @endif
                                        <input type="file" name="gallery[{{ $index }}][{{ $input }}]"
                                            accept="image/*" class="dropzone-input">
                                        <input type="hidden" name="gallery[{{ $index }}][old_{{ $input }}]"
                                            value="{{ $item[$input] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <label class="form-label">Опис</label>
                    <textarea name="gallery[{{ $index }}][description]" class="form-control">{{ old("gallery.$index.description", $item['description'] ?? '') }}</textarea>

                    <button type="button" class="btn btn-danger remove-gallery-item mt-2">Видалити</button>
                </div>
            @endforeach
        </div>

        {{-- Кнопки --}}
        <button type="submit" class="btn btn-success">Зберегти</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Відмінити</a>
    </form>

    {{-- === СКРИПТИ === --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hero image preview
            document.getElementById('hero_image').addEventListener('change', function (e) {
                const file = e.target.files[0];
                const preview = document.getElementById('preview-image');
                const dropzoneText = document.querySelector('#dropzone .dropzone-text');

                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        preview.src = event.target.result;
                        preview.style.display = 'block';
                        dropzoneText.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Галерея
            let galleryIndex = {{ count(old('gallery', $project->galleryItems)) }};
            const createDropzone = (inputName, index, label) => {
                return `
                    <label>${label}</label>
                    <div class="dropzone mb-2" data-preview-id="${inputName}-preview-${index}">
                        <div>
                            <span class="dropzone-text">Перетягніть або натисніть для завантаження</span>
                            <input type="file" name="gallery[${index}][${inputName}]" accept="image/*" class="dropzone-input">
                            <img id="${inputName}-preview-${index}" class="preview-image mt-2" style="display: none; max-width: 100%; border-radius: 8px;" />
                        </div>
                    </div>
                `;
            };

            document.getElementById('add-gallery-item').addEventListener('click', function () {
                const container = document.getElementById('gallery-items');
                const html = `
                    <div class="gallery-pair">
                        <div class="dropzones-flex">
                            <div>${createDropzone('design_image', galleryIndex, 'Рендер')}</div>
                            <div>${createDropzone('real_image', galleryIndex, 'Реальне фото')}</div>
                        </div>
                        <label class="form-label">Опис</label>
                        <textarea name="gallery[${galleryIndex}][description]" class="form-control mb-2"></textarea>
                        <button type="button" class="btn btn-danger remove-gallery-item">Видалити</button>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', html);
                initDropzones();
                galleryIndex++;
            });

            document.getElementById('gallery-items').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-gallery-item')) {
                    e.target.closest('.gallery-pair').remove();
                }
            });

            function initDropzones() {
                const dropzones = document.querySelectorAll('.dropzone');

                dropzones.forEach(dropzone => {
                    const input = dropzone.querySelector('input[type="file"]');
                    const previewId = dropzone.getAttribute('data-preview-id');
                    const previewImage = document.getElementById(previewId);
                    const dropzoneText = dropzone.querySelector('.dropzone-text');

                    function handleFile(file) {
                        if (file && file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                previewImage.src = e.target.result;
                                previewImage.style.display = 'block';
                                dropzoneText.style.display = 'none';
                            };
                            reader.readAsDataURL(file);
                        }
                    }

                    input.addEventListener('change', () => input.files.length > 0 && handleFile(input.files[0]));
                    dropzone.addEventListener('dragover', e => (e.preventDefault(), dropzone.classList.add('dragover')));
                    dropzone.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));
                    dropzone.addEventListener('drop', function (e) {
                        e.preventDefault();
                        dropzone.classList.remove('dragover');
                        const files = e.dataTransfer.files;
                        if (files.length > 0) {
                            input.files = files;
                            handleFile(files[0]);
                        }
                    });
                    dropzone.addEventListener('click', () => input.click());
                });
            }

            initDropzones();
        });
    </script>
@endsection
