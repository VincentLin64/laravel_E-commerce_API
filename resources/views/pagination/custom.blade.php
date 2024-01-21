{{--@if ($paginator->hasPages())--}}
    <nav aria-label="...">
        <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->previousPageUrl() }}"
                       rel="prev">{{ __('Previous') }}
                    </a>
                </li>
            @endif
            @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $key => $page)
                <li class="page-item {{ ($paginator->currentPage()) == $key ? 'active' : '' }}" aria-current="page">
                    <a class="page-link" href="{{$page}}">{{$key}}</a>
                </li>
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->nextPageUrl() }}"
                       rel="next">{{ __('Next') }}
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">{{ __('Next') }}</span>
                </li>
            @endif
        </ul>
    </nav>
{{--@endif--}}
