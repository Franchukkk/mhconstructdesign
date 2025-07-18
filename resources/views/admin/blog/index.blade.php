@extends('admin.layout')

@section('content')
    <style>
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .table-responsive {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        .table td, .table th {
            vertical-align: middle;
            white-space: nowrap;
        }
        .btn-success {
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            transform: translateY(-2px);
        }
        .btn-sm {
            margin: 0 3px;
        }
        .pagination {
            margin-top: 20px;
            justify-content: center;
        }
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>

    <h1>Блог</h1>

    <a href="{{ route('admin.blog.create') }}" class="btn btn-success mb-3">Нова стаття</a>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Слаг</th>
                    <th>Опубліковано</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug}}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-primary">Редагувати</a>
                            <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Ви впевнені?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $posts->links('pagination::bootstrap-5') }}
@endsection
