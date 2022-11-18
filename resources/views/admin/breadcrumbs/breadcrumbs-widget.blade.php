@php
    $first = true
@endphp


<div class="breadcrumbs">
    @foreach ($widget->links as $item)
        @if ($first)
            @php
                $first = false
            @endphp
        @else
            <span class="delim"></span>
        @endif
        <a href="{{$item->url}}">{{$item->caption}}</a>
    @endforeach
</div>