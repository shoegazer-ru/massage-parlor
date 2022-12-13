@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs', ['item' => 'model-creator', 'modelName' => $modelName, 'params' => $params])
@endsection

@section('content')
    @widget('app.admin.widgets.modelCreator', [
        'modelName' => $modelName
    ])
@endsection

@include('admin.assets.editor')