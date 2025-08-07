@extends('admin.layout')

@section('content')
    <style>
        h1 {
            font-size: 45rem;
        }

        label {
            font-size: 20rem;
        }

        form {
            max-width: 1248rem;
            padding: 24rem;
            background-color: #f9f9f9;
            border-radius: 12rem;
            box-shadow: 0 4rem 10rem rgba(0, 0, 0, 0.05);
        }

        form h1 {
            font-size: 28rem;
            margin-bottom: 24rem;
            text-align: center;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6rem;
            margin-top: 18rem;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10rem 12rem;
            border: 1rem solid #ccc;
            border-radius: 6rem;
            font-size: 16rem;
            background-color: #fff;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        button[type="submit"] {
            margin-top: 24rem;
            background-color: #007bff;
            color: white;
            padding: 12rem 20rem;
            border: none;
            border-radius: 6rem;
            cursor: pointer;
            font-size: 16rem;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1rem solid #c3e6cb;
            padding: 10rem 15rem;
            border-radius: 6rem;
            margin-bottom: 20rem;
        }

        h2 {
            color: #121212 !important;
            font-family: Poppins, sans-serif !important;
            font-size: 35rem !important;
            font-weight: 300 !important;
            line-height: 1.2em !important;
            margin-bottom: 34rem !important;
        }

        h3 {
            color: #121212 !important;
            font-family: Poppins, sans-serif !important;
            font-size: 30rem !important;
            font-weight: 300 !important;
            line-height: 1.2em !important;
            margin-bottom: 29rem !important;
        }

        h4 {
            color: #121212 !important;
            font-family: Poppins, sans-serif !important;
            font-size: 30rem !important;
            font-weight: 300 !important;
            line-height: 1.2em !important;
            margin-bottom: 29rem !important;
        }

        p {
            color: #121212 !important;
            font-family: Poppins, sans-serif !important;
            font-size: 25rem !important;
            font-weight: 300 !important;
            line-height: 1.2em !important;
            margin-bottom: 35rem !important;
        }

        .ck-content img {
            width: auto !important;
            aspect-ratio: auto !important;
            object-fit: contain !important;
            min-width: auto !important;
        }

        .ck-content .image img {
            width: auto !important;
            min-width: 300px !important;
            max-height: 480px !important;
            aspect-ratio: auto !important;
            object-fit: contain !important;
            min-width: auto !important;
            margin: 0 !important;
        }

        figure.image {
            margin: 0 !important;
        }

        .success-message {
            font-size: 18rem;
        }

        .mb-2 img {
            width: 100%;
        }

        .dropzone-text {
            font-size: 16rem;
        }

        #cover-dropzone:hover {
            background-color: #f0f8ff;
            border-color: #007bff;
        }

        .upload-icon {
            margin-bottom: 8rem;
        }

        button[type="button"]:not(.navbar button),
        button[type="submit"],
        .btn-secondary {
            width: 100%;
        }

        button[type="submit"] {
            margin-right: 10rem;
            margin-bottom: 5rem;
        }

        @media screen and (min-width: 480px) {

            .file-dropzone,
            .dropzone {
                max-width: 300px;
            }

            button[type="button"]:not(.navbar button),
            button[type="submit"],
            .btn-secondary {
                width: auto;
                margin-right: 0;
                margin-bottom: 0;
            }


        }
    </style>

    <h1>New article</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Title</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label class="form-label">Cover image</label>
            <div id="cover-dropzone"
                style="cursor: pointer; border: 2rem dashed #ccc; border-radius: 10rem; padding: 20rem; text-align: center; background: #fff; position: relative;">
                <div class="dropzone-inner"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <!-- SVG Upload Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="upload-icon" width="64rem" height="64rem" fill="none"
                        viewBox="0 0 24 24" stroke="#777" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0L8 12m4-4v12" />
                    </svg>

                    <!-- Text -->
                    <span class="dropzone-text" style="font-size: 16rem; color: #777;">Click to select an image</span>
                </div>

                <!-- Image preview -->
                <img id="cover-preview" style="display: none; max-width: 100%; margin-top: 10rem; border-radius: 10rem;" />
            </div>
            <input type="file" name="image" id="cover-image" style="display: none;" accept="image/*">
        </div>



        <div>
            <label>Content</label>
            <textarea name="body" id="editor" style="height: 400rem;"></textarea>
        </div>

        <button type="submit">Create</button>
    </form>


    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', '|',
                    'imageUpload',  // для завантаження через simpleUpload
                    'undo', 'redo'
                ],
                image: {
                    toolbar: [
                        'imageTextAlternative' // додає поле для alt
                    ]
                },
                simpleUpload: {
                    uploadUrl: '{{ route("admin.blog.upload") }}',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }
            })

            .then(editor => {
                // Лог при старті завантаження зображення
                editor.plugins.get('FileRepository').createUploadAdapter = loader => {
                    console.log('Файл для завантаження:', loader.file);

                    return {
                        upload() {
                            console.log('Стартує завантаження файлу...');
                            return loader.file
                                .then(file => {
                                    const formData = new FormData();
                                    formData.append('upload', file);

                                    return fetch('{{ route("admin.blog.upload") }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        },
                                        body: formData
                                    }).then(response => {
                                        if (!response.ok) {
                                            throw new Error(`HTTP error! status: ${response.status}`);
                                        }
                                        return response.json();
                                    }).then(data => {
                                        console.log('Відповідь сервера:', data);
                                        if (data.uploaded) {
                                            return { default: data.url };
                                        } else {
                                            throw new Error('Помилка завантаження: ' + (data.error || 'невідома'));
                                        }
                                    }).catch(err => {
                                        console.error('Помилка fetch:', err);
                                        throw err;
                                    });
                                });
                        },
                        abort() {
                            console.log('Завантаження файлу скасовано');
                        }
                    };
                };

                // Твої кастомні стилі для editable area
                // ...
            })
            .catch(error => {
                console.error(error);
            });


        // Cover image dropzone logic
        const coverInput = document.getElementById('cover-image');
        const coverDropzone = document.getElementById('cover-dropzone');
        const coverPreview = document.getElementById('cover-preview');
        const coverText = coverDropzone.querySelector('.dropzone-text');

        coverDropzone.addEventListener('click', () => coverInput.click());

        coverDropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            coverDropzone.style.borderColor = '#007bff';
        });

        coverDropzone.addEventListener('dragleave', () => {
            coverDropzone.style.borderColor = '#ccc';
        });

        coverDropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            coverDropzone.style.borderColor = '#ccc';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                coverInput.files = files;
                showCoverPreview(files[0]);
            }
        });

        coverInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) showCoverPreview(file);
        });

        function showCoverPreview(file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                coverPreview.src = e.target.result;
                coverPreview.style.display = 'block';
                coverText.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function showCoverPreview(file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                coverPreview.src = e.target.result;
                coverPreview.style.display = 'block';
                coverText.style.display = 'none';
                document.querySelector('#cover-dropzone .upload-icon').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

    </script>

@endsection