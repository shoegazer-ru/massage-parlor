<a href="">Все</a>
@foreach ($widget->sections as $section)
    <a href="">{{$section->model->caption}}</a>
@endforeach