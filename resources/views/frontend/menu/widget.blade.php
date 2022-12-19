<div class="menu-widget">
    @foreach ($widget->sections as $section)
        <a href="">{{$section->model->caption}}</a>
    @endforeach
</div>