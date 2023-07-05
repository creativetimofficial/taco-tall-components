@if ($paginator->hasPages())
    <nav>
        <ul class="flex">
            <li class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="pointer-events-none material-icons text-sm">keyboard_arrow_left</span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" aria-label="Previous">
                        <span class="material-icons text-sm">keyboard_arrow_left</span>
                    </button>
                @endif
            </li>

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li aria-disabled="true">
                        <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full bg-pink-500 p-0 text-sm text-white shadow-md transition duration-150 ease-in-out">{{ $element }}</a>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li id="page-{{ $page }}-current">
                                <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full bg-pink-500 p-0 text-sm text-white shadow-md transition duration-150 ease-in-out">{{ $page }}</a>
                            </li>
                        @else
                            <li id="page-{{ $page }}">
                                <a wire:click="gotoPage({{ $page }})" class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300" href="#">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <li class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300">
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" aria-label="Next">
                        <span class="material-icons text-sm">keyboard_arrow_right</span>
                    </button>
                @else
                    <span class="pointer-events-none material-icons text-sm">keyboard_arrow_right</span>
                @endif
            </li>
        </ul>
    </nav>
@endif