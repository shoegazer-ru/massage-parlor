@extends('admin.layouts.base')

@section('breadcrumbs')
    @widget('app.admin.widgets.breadcrumbs', ['item' => 'auth'])
@endsection

@section('content')
    @if ($errors->any())
        <div class="page-errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <form action="" method="post" class="auth-form">
        @csrf
        <div class="form-field">
            <label class="field-label">Login</label>
            <div class="field-control">
                <input type="text" name="name" value="">
            </div>
        </div>
        <div class="form-field">
            <label class="field-label">Password</label>
            <div class="field-control">
                <input type="password" name="password" value="">
            </div>
        </div>
        <button class="form-button" type="submit">Login</button>
    </form>
@endsection