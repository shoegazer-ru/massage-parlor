@foreach ($widget->publications as $item)
    <div class="products-item">
        <a href="" class="item-image" data-id="{{ $item->id }}">
            @if ($item->image)
                <img src="{{ $item->image->thumbSrc }}" alt="{{ $item->image->name }}">
            @endif
        </a>
        <div class="item-container">
            <a href="" class="item-caption" data-id="{{ $item->id }}">{{ $item->caption }}</a>
            <p class="item-annotation">{{ $item->annotation }}</p>
            <div class="item-buttons">
                <a href="" data-id="{{ $item->id }}">{{ $item->moreLabel }}</a>
                <button data-basket='{"id":"{{ $item->id }}", "caption":"{{ $item->caption }}", "url":""}'>{{ $item->basketLabel }}</button>
            </div>
        </div>
    </div>
@endforeach
