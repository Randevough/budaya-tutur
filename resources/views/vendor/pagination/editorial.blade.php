@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi Halaman Arsip" class="flex items-center justify-center space-x-2 sm:space-x-3 select-none">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="@lang('pagination.previous')" class="min-w-[44px] min-h-[44px] px-3 sm:px-4 flex items-center justify-center border border-linen-300 text-ink-400 bg-linen-200/40 cursor-not-allowed opacity-40 text-xs uppercase tracking-wider font-medium">
                <svg class="w-4 h-4 sm:mr-1.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                <span class="hidden sm:inline">Sebelumnya</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="min-w-[44px] min-h-[44px] px-3 sm:px-4 flex items-center justify-center border border-linen-300 text-ink-800 bg-linen-50 hover:bg-white hover:border-obsidian-950 hover:text-ink-950 active:translate-y-0.5 transition-all text-xs uppercase tracking-wider font-medium cursor-pointer shadow-sm">
                <svg class="w-4 h-4 sm:mr-1.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                <span class="hidden sm:inline">Sebelumnya</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center space-x-1.5 sm:space-x-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true" class="w-10 h-10 flex items-center justify-center text-ink-400 text-xs tracking-widest font-mono">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="w-11 h-11 flex items-center justify-center bg-obsidian-950 text-linen-50 border border-obsidian-950 text-xs sm:text-sm font-semibold shadow-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-11 h-11 flex items-center justify-center border border-linen-300 bg-linen-50 text-ink-800 text-xs sm:text-sm font-medium hover:border-obsidian-950 hover:text-ink-950 hover:bg-white active:translate-y-0.5 transition-all cursor-pointer shadow-sm" aria-label="Menuju halaman {{ $page }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="min-w-[44px] min-h-[44px] px-3 sm:px-4 flex items-center justify-center border border-linen-300 text-ink-800 bg-linen-50 hover:bg-white hover:border-obsidian-950 hover:text-ink-950 active:translate-y-0.5 transition-all text-xs uppercase tracking-wider font-medium cursor-pointer shadow-sm">
                <span class="hidden sm:inline">Selanjutnya</span>
                <svg class="w-4 h-4 sm:ml-1.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        @else
            <span aria-disabled="true" aria-label="@lang('pagination.next')" class="min-w-[44px] min-h-[44px] px-3 sm:px-4 flex items-center justify-center border border-linen-300 text-ink-400 bg-linen-200/40 cursor-not-allowed opacity-40 text-xs uppercase tracking-wider font-medium">
                <span class="hidden sm:inline">Selanjutnya</span>
                <svg class="w-4 h-4 sm:ml-1.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </span>
        @endif
    </nav>
@endif
