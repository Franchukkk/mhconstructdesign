@extends('admin.layout')

@section('content')
    <style>
        h1 {
            color: #333;
            margin-bottom: 24rem;
            /* 20px * 1.2 = 24px */
            font-size: 33.6rem;
            /* 28px * 1.2 = 33.6px */
            font-weight: 700;
        }

        .table-responsive {
            background-color: #fff;
            box-shadow: 0 0 12rem rgba(0, 0, 0, 0.1);
            /* 10px * 1.2 = 12px */
            border-radius: 4.8rem;
            /* 4px * 1.2 = 4.8px */
            padding: 14.4rem;
            /* 12px * 1.2 = 14.4px */
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2.4rem solid #dee2e6;
            /* 2px * 1.2 = 2.4px */
            font-weight: 600;
            font-size: 19.2rem;
            /* 16px * 1.2 = 19.2px */
            padding: 14.4rem 19.2rem;
            /* 12px 16px * 1.2 */
            text-align: left;
        }

        .table td,
        .table th {
            vertical-align: middle;
            white-space: nowrap;
            padding: 14.4rem 19.2rem;
            /* 12px 16px * 1.2 */
            font-size: 18rem;
            /* 15px * 1.2 = 18px */
            color: #212529;
        }

        .btn-success {
            transition: all 0.3s ease;
            padding: 7.2rem 14.4rem;
            /* 6px 12px * 1.2 */
            font-size: 16.8rem;
            /* 14px * 1.2 = 16.8px */
            border-radius: 4.8rem;
            /* 4px * 1.2 = 4.8px */
            font-weight: 600;
        }

        .btn-success:hover {
            transform: translateY(-2.4rem);
            /* -2px * 1.2 */
        }

        .btn-sm {
            margin: 0 3.6rem;
            /* 3px * 1.2 */
            padding: 4.8rem 9.6rem;
            /* 4px 8px * 1.2 */
            font-size: 14.4rem;
            /* 12px * 1.2 */
            border-radius: 3.6rem;
            /* 3px * 1.2 */
        }

        .pagination {
            margin-top: 24rem;
            /* 20px * 1.2 */
            justify-content: center;
            font-size: 16.8rem;
            /* 14px * 1.2 */
        }

        @media (max-width: 921.6rem) {

            /* 768px * 1.2 */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>



    <h1>Blog</h1>

    <a href="{{ route('admin.blog.create') }}" class="btn btn-success mb-3">New article</a>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Date</th>
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
                            <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Ви впевнені?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $posts->links('pagination::bootstrap-5') }}
@endsection