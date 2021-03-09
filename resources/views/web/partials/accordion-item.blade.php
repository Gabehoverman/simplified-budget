<div class="border-bottom pb-3 mb-3">
    <div data-target="#panel-{{ $index }}" class="accordion-panel-title collapsed" data-toggle="collapse"
        role="button" aria-expanded="false" aria-controls="panel-1">
        <span class="h6 mb-0">{{ $title }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            class="injected-svg icon" data-src="assets/img/icons/interface/plus.svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <path
                d="M19 11H5C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11Z"
                fill="#212529"></path>
            <path
                d="M13 19L13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5L11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19Z"
                fill="#212529"></path>
        </svg>
    </div>
    <div class="collapse" id="panel-{{ $index }}" style="">
        <div class="pt-3">
            <p class="mb-0">
                {{ $body }}
            </p>
        </div>
    </div>
</div>
