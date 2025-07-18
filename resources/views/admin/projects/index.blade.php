@extends('admin.layout')

@section('title', 'Проєкти портфоліо')

@section('content')

    <style>
        .admin-title {
            font-weight: 700;
            font-size: 2.4rem;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
            color: var(--color-primary);
        }
        .add-project-btn {
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            background-color: lightblue;
            border: 2px solid darkcyan;
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
            margin-bottom: 2rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            min-width: 600px;
        }
        .admin-table th {
            background-color: #f8f9fa;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            white-space: nowrap;
        }
        .admin-table td {
            padding: 1rem;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
        }
        .action-btn {
            font-size: 0.85rem;
            padding: 0.35rem 0.7rem;
            margin-right: 0.5rem;
            white-space: nowrap;
        }
        .empty-message {
            text-align: center;
            padding: 2rem 0;
            font-style: italic;
            color: var(--color-muted);
        }
        .pagination-container {
            margin-top: 2rem;
        }
    </style>

    <h1 class="admin-title">
        Проєкти портфоліо
    </h1>


    <a href="{{ route('admin.projects.create') }}" class="btn add-project-btn">
        Додати новий проєкт
    </a>

    <div class="table-responsive">
        <table role="table" aria-label="Список проєктів" tabindex="0" aria-live="polite" class="admin-table">
            <thead>
                <tr>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Слаг</th>
                    <th scope="col">Дата створення</th>
                    <th scope="col" style="min-width: 160px;">Дії</th>
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
                                Редагувати
                            </a>

                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Видалити цей проєкт?');" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger action-btn">
                                    Видалити
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>

                        <td colspan="4" class="empty-message">
                            Проєктів немає
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
