@section('head-assets')
    <link rel="stylesheet" href="{{ asset('lib/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/filepond/filepond-plugin-image-preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/flatpickr/flatpickr.min.css') }}">
@endsection

@section('body-assets')
    <script src="{{ asset('lib/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('lib/filepond/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('lib/filepond/filepond.jquery.js') }}"></script>
    <script src="{{ asset('lib/quill/quill.min.js') }}"></script>
    <script src="{{ asset('lib/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('lib/flatpickr/ru.js') }}"></script>
@endsection