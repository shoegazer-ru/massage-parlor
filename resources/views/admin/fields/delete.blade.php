@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs', ['item' => 'field-deletor', 'fieldName' => $fieldName, 'modelId' => $modelId])
@endsection

@section('content')
    @widget('app.admin.widgets.fieldDeletor', [
        'fieldName' => $fieldName,
        'modelId' => $modelId
    ])
@endsection