@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Sebelumnya</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a>
                </li>
            @endif

            @php
                $window = 1; // Show only 1 page before and after the current page
                $start = max(1, $paginator->currentPage() - $window);
                $end = min($paginator->lastPage(), $paginator->currentPage() + $window);
            @endphp

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Selanjutnya</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Selanjutnya</span>
                </li>
            @endif
        </ul>
    </nav>
@endif