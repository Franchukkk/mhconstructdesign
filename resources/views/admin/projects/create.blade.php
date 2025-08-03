@extends('admin.layout')

@section('content')
    <style>
        label {
            font-size: 16rem;
        }
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

        .gallery-pair {
            padding: 12rem;
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

        .file-dropzone:hover {
            border-color: #007bff;
            background-color: #f0f8ff;
        }

        .file-dropzone span {
            font-size: 16.8rem;
            color: #555;
            margin-top: 9.6rem;
        }

        .icon-upload {
            width: 38.4rem;
            height: 38.4rem;
            color: #007bff;
        }

        .file-dropzone.dragover {
            border-color: #28a745;
            background-color: #e6ffee;
        }

        .file-dropzone.dragover .icon-upload {
            color: #28a745;
        }

        .file-dropzone.dragover span {
            color: #28a745;
        }

        .file-dropzone img {
            margin-top: 14.4rem;
            max-width: 100%;
            max-height: 192rem;
            border-radius: 8.4rem;
            object-fit: contain;
            box-shadow: 0 2.4rem 9.6rem rgba(0, 0, 0, 0.1);
        }

        .gallery-pair img {
            box-shadow: 0 1.2rem 6rem rgba(0, 0, 0, 0.1);
            object-fit: contain;
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
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s, background-color 0.3s;
            background-color: #fafafa;
        }

        .dropzones-flex>div {
            width: 280px;
        }

        @media screen and (max-width: 600px) {
            .dropzones-flex>div {
                width: 100%;
            }
            
        }

        .dropzone.dragover {
            border-color: #28a745;
            background-color: #e6ffed;
        }

        .dropzone-text {
            color: #555;
            font-size: 14px;
        }

        .dropzone-input {
            display: none;
        }

        .upload-icon {
            margin-bottom: 6px;
            color: #999;
        }

        .dropzones-flex {
            display: flex;
            gap: 20rem;
            flex-wrap: wrap;
        }

        .mb-3 {
            margin-bottom: 13rem !important;
        }
        .mb-2 {
            margin-bottom: 10rem !important;
        }
    </style>



    <h1>Create new project</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Hero Image</label>
            <label for="hero_image" class="file-dropzone" id="dropzone">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-upload" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                </svg>
                <span class="dropzone-text">Click to select an image</span>
                <img id="preview-image" src="#" alt="Попередній перегляд" style="display: none;" />
                <input type="file" name="hero_image" id="hero_image" accept="image/*" hidden>
            </label>


            @error('hero_image')<div class="text-danger">{{ $message }}</div>@enderror
        </div>


        <div class="mb-3">
            <label for="area" class="form-label">Area (ft<sup>2</sup>)</label>
            <input type="text" name="area" id="area" class="form-control" value="{{ old('area') }}">
            @error('area')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="implementation_time" class="form-label">Implementation Time (months)</label>
            <input type="text" name="implementation_time" id="implementation_time" class="form-control"
                value="{{ old('implementation_time') }}">
            @error('implementation_time')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="design_time" class="form-label">Project Development Time (weeks)</label>
            <input type="text" name="design_time" id="design_time" class="form-control" value="{{ old('design_time') }}">
            @error('design_time')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="style" class="form-label">Style</label>
            <input type="text" name="style" id="style" class="form-control" value="{{ old('style') }}">
            @error('style')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Address</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
            @error('location')<div class="text-danger">{{ $message }}</div>@enderror
        </div>



        <div id="gallery-container" class="mb-4">
            <h3>Gallery (Render / Real Photo)</h3>

            <button type="button" id="add-gallery-item" class="btn btn-primary mb-3">Add</button>

            <div id="gallery-items">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <script>
        let galleryIndex = 0;

        const createDropzone = (inputName, index, label) => {
            return `
                <label>${label}</label>
                <div class="dropzone mb-2" data-preview-id="${inputName}-preview-${index}">
                    
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="upload-icon" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"/>
                        </svg>
                        <br>
                        <span class="dropzone-text">Click to select an image</span>
                        <input type="file" name="gallery[${index}][${inputName}]" accept="image/*" class="dropzone-input">
                        <img id="${inputName}-preview-${index}" class="preview-image mt-2" style="display: none; max-width: 100%; border-radius: 8px;" />
                    </div>
                </div>
            `;
        };

        document.getElementById('add-gallery-item').addEventListener('click', function () {
            const container = document.getElementById('gallery-items');
            const html = `
                <div class="gallery-pair mb-3 border">
                    <div class="dropzones-flex">
                    <div>${createDropzone('design_image', galleryIndex, 'Render:')}</div>
                    <div>${createDropzone('real_image', galleryIndex, 'Real picture:')}</div>
                    </div>
                    <button type="button" class="btn btn-danger remove-gallery-item">Delete</button>
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

                input.addEventListener('change', function () {
                    if (input.files.length > 0) {
                        handleFile(input.files[0]);
                    }
                });

                dropzone.addEventListener('dragover', function (e) {
                    e.preventDefault();
                    dropzone.classList.add('dragover');
                });

                dropzone.addEventListener('dragleave', function () {
                    dropzone.classList.remove('dragover');
                });

                dropzone.addEventListener('drop', function (e) {
                    e.preventDefault();
                    dropzone.classList.remove('dragover');

                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        input.files = files;
                        handleFile(files[0]);
                    }
                });

                dropzone.addEventListener('click', function () {
                    input.click();
                });
            });
        }

        document.addEventListener('DOMContentLoaded', initDropzones);

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


    </script>


@endsection