@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs', [
        'item' => 'model-list', 
        'modelName' => $modelName,
        'params' => $params
    ])
@endsection

@section('content')
    @widget('app.admin.widgets.modelList', [
        'modelName' => $modelName,
        'params' => $params
    ])
@endsection