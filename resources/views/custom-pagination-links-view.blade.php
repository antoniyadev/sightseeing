<div>
    @if ($paginator->hasPages())
    <div
        role="navigation"
        aria-label="Pagination Navigation"
        class="grid grid-cols-2 join"
    >
        <button
            wire:click="previousPage"
            wire:loading.attr="disabled"
            rel="prev"
            class="join-item btn btn-outline {{($paginator->onFirstPage()) ? 'btn-disabled' : ''}}"
        >
            Previous page
        </button>

        <button
            wire:click="nextPage"
            wire:loading.attr="disabled"
            rel="next"
            class="join-item btn btn-outline {{(!$paginator->hasMorePages()) ? 'btn-disabled' : ''}}"
        >
            Next
        </button>
    </div>
    @endif
</div>
