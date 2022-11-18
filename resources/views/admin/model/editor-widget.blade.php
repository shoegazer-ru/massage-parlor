<div class="editor-widget">
    <p class="widget-note">
        {{ $editor->note }}
    </p>

    @if ($editor->messages)
        <div class="page-messages">
            @foreach ($editor->messages as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
    @endif

    <div class="widget-form">
        @include('admin.forms.form', ['form' => $editor->form])
    </div>
</div>