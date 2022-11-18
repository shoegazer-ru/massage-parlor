@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs')
@endsection

@section('content')
    <div class="logged-user">
        <p>Пользователь {{$user->name}} <a href="{{route('logout')}}">Выйти</a></p>
    </div>

    @widget('app.admin.widgets.dashboardMenu')
@endsection