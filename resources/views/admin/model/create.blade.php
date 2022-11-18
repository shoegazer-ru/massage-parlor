@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs', ['item' => 'model-creator', 'modelName' => $modelName, 'sectionId' => $sectionId])
@endsection

@section('content')
    @widget('app.admin.widgets.modelCreator', [
        'modelName' => $modelName
    ])
@endsection