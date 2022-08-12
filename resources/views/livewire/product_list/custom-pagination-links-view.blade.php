<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="btn btn-outline-secondary">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <button type="button" class="btn btn-primary" wire:click="previousPage"  rel="prev" >{!! __('pagination.previous') !!}</button>

                @endif
            </span>
 
            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button type="button" class="btn btn-primary" wire:click="nextPage"  rel="next" >{!! __('pagination.next') !!}</button>
                @else
                    <span class="btn btn-outline-secondary">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>