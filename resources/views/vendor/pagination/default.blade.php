@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-previous disabled">@lang('pagination.previous')</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous" rel="prev">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next" rel="next">@lang('pagination.next')</a>
        @else
            <span class="pagination-next disabled">@lang('pagination.next')</span>
        @endif

        {{-- Pagination Elements --}}
        <div class="hidden md:flex">
            {{-- Array Of Links --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-ellipsis">&hellip;</span>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="pagination-link is-current">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-link" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Pagination Stats --}}
        <div class="hidden md:flex items-center ml-6">
            <span class="pagination-status">
                @lang('Showing')
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                @lang('to')
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @lang('of')
                <span class="font-medium">{{ $paginator->total() }}</span>
                @lang('results')
            </span>
        </div>
    </nav>
@endif
