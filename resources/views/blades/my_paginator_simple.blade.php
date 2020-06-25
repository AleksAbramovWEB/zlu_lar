@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-around mb-0 pagination-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="text-secondary" aria-hidden="true">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="page-item">
                    <a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        @lang('pagination.previous')
                    </a>
                </li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="text-secondary disabled ml-1" aria-disabled="true"><span class="">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active ml-1" aria-current="page"><span class="text-secondary">{{ $page }}</span></li>
                        @else
                            <li class="page-item ml-1"><a class="" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item ml-1">
                    <a class="" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">@lang('pagination.next')</a>
                </li>
            @else
                <li class=" disabled ml-1" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="text-secondary" aria-hidden="true">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
