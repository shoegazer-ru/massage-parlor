@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs', ['item' => 'fields-list', 'fieldName' => $fieldName])
@endsection

@section('content')
    @widget('app.admin.widgets.fieldsList', ['fieldName' => $fieldName])
@endsection