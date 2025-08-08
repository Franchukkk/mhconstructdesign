@extends('admin.layout')

@section('title', 'Contact Requests')

@section('content')
    <style>
        .requests-wrapper {
            padding: 24px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #222;
        }

        .requests-title {
            font-size: 32px;
            margin-bottom: 16px;
            font-weight: 700;
        }

        .export-btn {
            display: inline-block;
            margin-bottom: 16px;
            padding: 8px 16px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            user-select: none;
        }

        .export-btn:hover {
            background-color: #0056b3;
        }

        .table-container {
            overflow-x: auto;
        }

        table.requests-table {
            width: 100%;
            min-width: 1500px;
            border-collapse: collapse;
            font-size: 14px;
        }

        table.requests-table th,
        table.requests-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            vertical-align: top;
            text-align: left;
            font-size: 14px;
        }

        table.requests-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        /* Ширина колонок */
        table.requests-table th:nth-child(1) {
            width: 50px;
        }

        /* id */
        table.requests-table th:nth-child(2) {
            width: 140px;
        }

        /* full_name */
        table.requests-table th:nth-child(3) {
            width: 180px;
        }

        /* email */
        table.requests-table th:nth-child(4) {
            width: 120px;
        }

        /* phone */
        table.requests-table th:nth-child(5) {
            width: 100px;
        }

        /* how_heard */
        table.requests-table th:nth-child(6) {
            width: 180px;
        }

        /* services_selected */
        table.requests-table th:nth-child(7) {
            width: 140px;
        }

        /* gclid */
        table.requests-table th:nth-child(8) {
            width: 140px;
        }

        /* client_id */
        table.requests-table th:nth-child(9) {
            width: 220px;
        }

        /* referrer */
        table.requests-table th:nth-child(10) {
            width: 220px;
        }

        /* page_url */
        table.requests-table th:nth-child(11) {
            width: 120px;
        }

        /* ip_address */
        table.requests-table th:nth-child(12) {
            width: 250px;
        }

        /* user_agent */
        table.requests-table th:nth-child(13) {
            width: 130px;
        }

        /* created_at */
        table.requests-table th:nth-child(14) {
            width: 130px;
        }

        /* updated_at */

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        ul.services-list {
            padding-left: 16px;
            margin: 0;
            list-style-type: disc;
            font-size: 14px;
        }

        ul.services-list li {
            margin-bottom: 4px;
        }

        a.page-url-link {
            color: #007bff;
            text-decoration: none;
            word-break: break-all;
        }

        a.page-url-link:hover {
            text-decoration: underline;
        }

        .td-width {
            min-width: 300px;
        }
    </style>

    <div class="requests-wrapper">
        <h1 class="requests-title">Requests</h1>

        <form action="{{ route('admin.requests.clear') }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="export-btn" style="background-color: #dc3545;"
                onclick="return confirm('Are you sure that you want to clear all requests?')">
                Clear all requests
            </button>
        </form>


        <a href="{{ route('export.contact.requests') }}" class="export-btn">Export to Excel</a>

        <div class="table-container">
            <table class="requests-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>full_name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>how_heard</th>
                        <th>services_selected</th>
                        <th>Project details</th>
                        <th>Timeframe Flexibility</th>
                        <th>gclid</th>
                        <th>client_id</th>
                        <th>referrer</th>
                        <th>page_url</th>
                        <th>ip_address</th>
                        <th>user_agent</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr class="table-row-main">
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->full_name }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->phone ?? '-' }}</td>
                            <td>{{ $request->how_heard ?? '-' }}</td>
                            <td class="td-width">
                                @if(is_array($request->services_selected))
                                    <ul class="services-list">
                                        @foreach($request->services_selected as $service)
                                            <li>{{ $service }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $request->services_selected ?? '-' }}
                                @endif
                            </td>
                            <td class="td-width">
                                {{ $request->project_details }}
                            </td>
                            <td class="td-width">
                                {{ $request->timeframe_flexibility }}
                            </td>
                            <td>{{ $request->gclid ?? '-' }}</td>
                            <td>{{ $request->client_id ?? '-' }}</td>
                            <td class="td-width">
                                @if ($request->referrer)
                                    <a href="{{ $request->referrer }}" target="_blank" class="page-url-link">
                                        {{ parse_url($request->referrer, PHP_URL_HOST) }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="td-width">
                                @if ($request->page_url)
                                    <a href="{{ $request->page_url }}" target="_blank" class="page-url-link">
                                        {{ parse_url($request->page_url, PHP_URL_PATH) ?: $request->page_url }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $request->ip_address ?? '-' }}</td>
                            <td class="td-width" style="white-space: pre-wrap;">{{ $request->user_agent ?? '-' }}</td>
                            <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $request->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" style="text-align: center;">No requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $requests->links() }}
        </div>
    </div>
@endsection