<form action="{{ $form->action }}" method="{{ $form->method }}" enctype="multipart/form-data">
    @csrf
    @foreach ($form->fields as $field)
        <div class="form-field">
            @switch($field->type)
                @case('button')
                @case('submit')
                    <div class="field-button">
                        <button type="{{ $field->type }}" class="form-button">{{ $field->label }}</button>
                    </div>
                    @break
                @case('hidden')
                    <input type="hidden" name="{{ $field->name }}" value="{{ $field->value }}"/>
                    @break
                @default
                    <label for="" class="field-label">{{ $field->label }}</label>
                    <div class="field-control field-type-{{ $field->type }}">
                        @switch($field->type)
                            @case('texteditor')
                                <textarea name="{{ $field->name }}" id="" cols="30" rows="10">{{ $field->value }}</textarea>
                                <div class="field-texteditor"></div>
                                @break
                            @case('datepicker')
                            <input type="date" name="{{ $field->name }}" value="{{ $field->value }}" lang="ru-RU"/>
                                @break
                            @case('files')
                                @include('admin.forms.fields.files', ['field' => $field])
                                @break
                            @default
                                <input type="text" name="{{ $field->name }}" value="{{ $field->value }}"/>
                        @endswitch
                    </div>
            @endswitch
        </div>
    @endforeach
</form>