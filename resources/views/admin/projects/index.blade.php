@extends('admin.layout')

@section('title', 'Проєкти портфоліо')

@section('content')

    <style>
        .admin-title {
            font-weight: 700;
            font-size: 30rem;
            /* 30px */
            margin-bottom: 20rem;
            /* 20px */
            letter-spacing: 1.2rem;
            /* 1.2px */
            color: var(--color-primary);
        }

        .add-project-btn {
            text-transform: uppercase;
            margin-bottom: 20rem;
            /* 20px */
            background-color: lightblue;
            border: 2.5rem solid darkcyan;
            /* 2.5px */
            padding: 14rem 24rem;
            /* 14px вертикально, 24px горизонтально */
            font-size: 18rem;
            /* 18px */
            cursor: pointer;
            color: black;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: inline-block;
            user-select: none;
            border-radius: 6rem;
            /* 6px */
        }

        .add-project-btn:hover {
            background-color: darkcyan;
            color: white;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24rem;
            /* 24px */
            box-shadow: 0 0 15rem rgba(0, 0, 0, 0.1);
            /* 15px тінь */
            min-width: 720rem;
            /* 720px */
            font-size: 16rem;
            /* 16px текст в таблиці */
        }

        .admin-table th {
            background-color: #f8f9fa;
            padding: 16rem;
            /* 16px */
            text-align: left;
            border-bottom: 3rem solid #dee2e6;
            /* 3px */
            white-space: nowrap;
            font-weight: 600;
        }

        .admin-table td {
            padding: 16rem;
            /* 16px */
            background: #fff;
            border-bottom: 1.5rem solid #dee2e6;
            /* 1.5px */
        }

        .action-btn {
            font-size: 14rem;
            /* 14px */
            padding: 10rem 16rem;
            /* 10px 16px */
            margin-right: 8rem;
            /* 8px */
            white-space: nowrap;
            border-radius: 4rem;
            /* 4px */
            cursor: pointer;
            user-select: none;
            display: inline-block;
            transition: background-color 0.2s ease;
        }

        .empty-message {
            text-align: center;
            padding: 24rem 0;
            /* 24px вертикально */
            font-style: italic;
            color: var(--color-muted);
            font-size: 16rem;
            /* 16px */
        }

        .pagination-container {
            margin-top: 24rem;
            /* 24px */
        }
    </style>


    <h1 class="admin-title">
        Portfolio Projects
    </h1>


    <a href="{{ route('admin.projects.create') }}" class="btn add-project-btn">
        Create new project
    </a>

    <div class="table-responsive">
        <table role="table" aria-label="Список проєктів" tabindex="0" aria-live="polite" class="admin-table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Date</th>
                    <th scope="col" style="min-width: 160px;" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->slug }}</td>
                        <td>{{ $project->created_at->format('d.m.Y') }}</td>
                        <td>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning action-btn">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                onsubmit="return confirm('Видалити цей проєкт?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
    
                                <button type="submit" class="btn btn-danger action-btn">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>

                        <td colspan="4" class="empty-message">
                            There are no projects yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $projects->links('pagination::bootstrap-5') }}

    </div>
@endsection