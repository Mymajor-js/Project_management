@if ($paginator->hasPages())
    <nav class="custom-pagination">
        {{-- ปุ่ม Previous --}}
        @if ($paginator->onFirstPage())
            <span class="disabled">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
        @endif

        {{-- แสดงหน้าแรก --}}
        @if ($paginator->currentPage() > 3)
            <a href="{{ $paginator->url(1) }}">1</a>
            <span class="disabled">...</span>
        @endif

        {{-- ลิสต์หน้า --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    {{-- เพิ่มเงื่อนไขให้แสดงเฉพาะเลขใกล้เคียงกับหน้าปัจจุบัน --}}
                    @if ($page == $paginator->currentPage())
                        <span class="active">{{ $page }}</span>
                    @elseif ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1)
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- แสดงเลขสุดท้าย --}}
        @if ($paginator->currentPage() < $paginator->lastPage() - 2)
            <span class="disabled">...</span>
            <a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
        @endif

        {{-- ปุ่ม Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
        @else
            <span class="disabled">&raquo;</span>
        @endif
    </nav>
@endif
