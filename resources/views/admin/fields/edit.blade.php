@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs', ['item' => 'field-editor', 'fieldName' => $fieldName, 'modelId' => $modelId])
@endsection

@section('content')
    @widget('app.admin.widgets.fieldEditor', [
        'fieldName' => $fieldName,
        'modelId' => $modelId
    ])
@endsection

@include('admin.assets.editor')