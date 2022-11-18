@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs', ['item' => 'model-editor', 'modelName' => $modelName, 'modelId' => $modelId, 'sectionId' => $sectionId])
@endsection

@section('content')

    @widget('app.admin.widgets.modelEditor', [
        'modelName' => $modelName,
        'modelId' => $modelId
    ])
@endsection

@include('admin.assets.editor')