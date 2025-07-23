@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
            @endphp

            {{-- "..." before --}}
            @if ($start > 1)
                <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
                @if ($start > 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endif

            {{-- Page numbers --}}
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $i == $current ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- "..." after --}}
            @if ($end < $last)
                @if ($end < $last - 1)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($last) }}">{{ $last }}</a></li>
            @endif
        </ul>
    </nav>
@endif
