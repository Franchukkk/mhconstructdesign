@extends('admin.layout')

@section('content')
    <style>
        h1 {
            font-size: 50rem;
        }

        label {
            font-size: 20rem;
        }

        form {
            max-width: 1041rem;
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
            font-size: 64rem !important;
            font-weight: 300 !important;
            line-height: 60rem !important;
            text-transform: uppercase !important;
            margin-bottom: 34rem !important;
        }
        h3 {
            color: #121212 !important;
            font-family: Poppins, sans-serif !important;
            font-size: 48rem !important;
            font-weight: 300 !important;
            line-height: 45rem !important;
            text-transform: uppercase !important;
            margin-bottom: 29rem !important;
        }
        h4 {
            color: #121212 !important;
            font-family: Poppins, sans-serif !important;
            font-size: 32rem !important;
            font-weight: 300 !important;
            line-height: 45rem !important;
            text-transform: uppercase !important;
            margin-bottom: 29rem !important;
        }
        p {
            color: #121212 !important;
            font-family: Poppins, sans-serif !important;
            font-size: 32rem !important;
            font-weight: 300 !important;
            line-height: 32rem !important;
            text-transform: uppercase !important;
            margin-bottom: 35rem !important;
        }
        .ck-content img {
            width: 993rem !important;
            aspect-ratio: 1 / 1 !important;
            object-fit: cover !important;
        }

        .success-message {
            font-size: 18rem;
        }
    </style>

    <h1>Нова стаття</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Заголовок</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>Обкладинка</label>
            <input type="file" name="image">
        </div>

        <div>
            <label>Контент</label>
            <textarea name="body" id="editor" style="height: 400rem;"></textarea>
        </div>

        <button type="submit">Зберегти</button>
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
                    'imageStyle:full',
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
    </script>
@endsection
