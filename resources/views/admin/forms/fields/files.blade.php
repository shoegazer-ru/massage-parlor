@if ($field->data['filesMap'] ?? null)
    <div class="uploaded-files">
        @foreach ($field->data['filesMap'] as $type=>$files)
            <div class="files-list {{ $type }}">
                @foreach ($files as $file)
                    @switch($type)
                        @case('image')
                            <div class="image-item">
                                <img src="{{ $file->src }}" alt="{{ $file->caption }}" />
                                <div class="item-actions">
                                    @foreach ($file->actions as $action)
                                        <a href="{{ $action->url }}" class="{{ $action->name }}" title="{{ $action->caption }}"></a>
                                    @endforeach
                                </div>
                            </div>
                            @break
                        @default
                            <div class="file-item">
                                <p>{{ $file->caption }} <span class="size">{{ $file->size }}</span></p>
                                <div class="item-actions">
                                    @foreach ($file->actions as $action)
                                        <a href="{{ $action->url }}" class="{{ $action->name }}"">{{ $action->caption }}</a>
                                    @endforeach
                                </div>
                            </div>
                    @endswitch
                @endforeach
            </div>
        @endforeach
    </div>
@endif
<div class="upload-container" data-upload-url="{{ $field->data['uploadUrl'] }}">
    <input type="file" name="{{ $field->name }}"/>
</div>