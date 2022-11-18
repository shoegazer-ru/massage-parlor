<div class="model-list-widget">
    <div class="widget-actions">
        @foreach ($widget->actions as $action)
            <a href="{{$action->url}}" class="page-action">{{$action->caption}}</a>
        @endforeach
    </div>

    @foreach ($widget->models as $item)
        <div class="list-item">
            <p class="item-caption">{{$item->caption}}</p>
            @foreach ($item->actions as $action)
                <a href="{{$action->url}}" class="page-action">{{$action->caption}}</a>
            @endforeach
        </div>
    @endforeach
</div>