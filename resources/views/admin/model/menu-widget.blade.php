<div class="menu-widget">
    <div class="widget-actions">
        @foreach ($widget->actions as $action)
            <a href="{{$action->url}}">{{$action->caption}}</a>
        @endforeach
    </div>

    <div class="widget-links">
        @foreach ($widget->links as $item)
            <div class="links-item">
                <a href="{{$item->url}}">{{$item->caption}}</a>
            </div>
        @endforeach
    </div>
</div>