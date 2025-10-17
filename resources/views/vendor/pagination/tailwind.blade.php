
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="custom-pagination">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled" aria-disabled="true">
                    <span class="pagination-link">‹ Précédent</span>
                </li>
            @else
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-link">‹ Précédent</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item disabled" aria-disabled="true">
                        <span class="pagination-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item active" aria-current="page">
                                <span class="pagination-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-link">Suivant ›</a>
                </li>
            @else
                <li class="pagination-item disabled" aria-disabled="true">
                    <span class="pagination-link">Suivant ›</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
