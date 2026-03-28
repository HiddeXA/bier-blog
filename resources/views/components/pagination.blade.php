@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination" class="flex items-center justify-between mt-12 pt-8 border-t border-amber-200">

    {{-- Left: result info --}}
    <p class="text-xs text-amber-700 font-light tracking-wide" style="font-family: 'Lato', sans-serif;">
        Showing
        <span class="font-semibold text-bark-900">{{ $paginator->firstItem() }}</span>
        &ndash;
        <span class="font-semibold text-bark-900">{{ $paginator->lastItem() }}</span>
        of
        <span class="font-semibold text-bark-900">{{ $paginator->total() }}</span>
        posts
    </p>

    {{-- Right: page buttons --}}
    <div class="flex items-center gap-1">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-3 py-2 text-amber-300 cursor-not-allowed select-none" aria-disabled="true">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="inline-flex items-center px-3 py-2 text-amber-600 hover:text-amber-800 transition-colors duration-200"
               rel="prev" aria-label="Previous page">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        @endif

        {{-- Page numbers --}}
        @foreach ($elements as $element)

            {{-- Ellipsis --}}
            @if (is_string($element))
                <span class="px-2 py-2 text-amber-400 text-sm select-none" style="font-family: 'Lato', sans-serif;">
                    &hellip;
                </span>
            @endif

            {{-- Page links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{-- Active page --}}
                        <span aria-current="page"
                              class="inline-flex items-center justify-center w-9 h-9 text-sm font-semibold rounded-sm border border-amber-300 text-amber-800 select-none"
                              style="font-family: 'Lato', sans-serif; background: #f2d9ac;">
                            {{ $page }}
                        </span>
                    @else
                        {{-- Inactive page --}}
                        <a href="{{ $url }}"
                           class="inline-flex items-center justify-center w-9 h-9 text-sm font-light rounded-sm border border-transparent text-amber-700 transition-all duration-200"
                           style="font-family: 'Lato', sans-serif;"
                           onmouseover="this.style.background='#f9eedb'; this.style.borderColor='#e9bf74';"
                           onmouseout="this.style.background=''; this.style.borderColor='transparent';"
                           aria-label="Go to page {{ $page }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif

        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="inline-flex items-center px-3 py-2 text-amber-600 hover:text-amber-800 transition-colors duration-200"
               rel="next" aria-label="Next page">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        @else
            <span class="inline-flex items-center px-3 py-2 text-amber-300 cursor-not-allowed select-none" aria-disabled="true">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        @endif

    </div>
</nav>
@endif