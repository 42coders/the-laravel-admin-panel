<div class="mb-3 col-md-{{ $field->col ?? '12' }}">
    <label for="{{ $field->name }}" class="form-label">{{ $field->label ?? $field->name }}</label>
    <input class="form-control @error($field->name) is-invalid @enderror" type="file" id="{{ $field->name }}" name="{{ $field->name }}" onchange="preview()" @if(old($field->name)) value="{{ old($field->name) }}" @else value="{{ $value }}"  @endif>
    @if(isset($field->description))
        <p class="mt-2 text-sm text-gray-500">
            {{ $field->description }}
        </p>
    @endif
    @error($field->name)
    <p class="invalid-feedback" id="{{ $field->name }}-error">{{ $message }}</p>
    @enderror
    <img id="frame_{{ $field->name }}" src="" class="img-fluid" style="border-radius: 10px; margin-top: 20px;"/>
</div>
<script>
    function preview() {
        frame_{{ $field->name }}.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
