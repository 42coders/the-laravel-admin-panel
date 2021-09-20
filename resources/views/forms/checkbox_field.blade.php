<div class="mb-3 col-md-{{ $field->col ?? '12' }}">
    <input class="form-check-input @error($field->name) is-invalid @enderror" type="checkbox" id="{{ $field->name }}" name="{{ $field->name }}" placeholder="{{ $field->label ?? $field->name }}" aria-describedby="{{ $field->name }}-error"
           @if(old($field->name)) checked="checked" @else @if($value) checked="checked" @endif  @endif value="1">
    <label class="form-check-label" for="{{ $field->name }}">
        {{ $field->label ?? $field->name }}
    </label>
    @if(isset($field->description))
        <p class="mt-2 text-sm text-gray-500">
            {{ $field->description }}
        </p>
    @endif
    @error($field->name)
    <p class="invalid-feedback" id="{{ $field->name }}-error">{{ $message }}</p>
    @enderror
</div>
