<div class="menu-widget">
    <div class="widget-links">
        @foreach ($widget->links as $item)
            <div class="links-item">
                <a href="{{$item->url}}">{{$item->caption}}</a>
            </div>
        @endforeach
    </div>
</div>