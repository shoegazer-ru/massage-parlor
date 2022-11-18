@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs', ['item' => 'model-deletor', 'modelName' => $modelName, 'modelId' => $modelId, 'sectionId' => $sectionId])
@endsection

@section('content')
    @widget('app.admin.widgets.modelDeletor', [
        'modelName' => $modelName,
        'modelId' => $modelId
    ])
@endsection