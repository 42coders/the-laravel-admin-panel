<div class="mb-3 col-md-{{ $field->col ?? '12' }}">
    <label for="{{ $field->name }}" class="form-label">{{ $field->label ?? $field->name }}</label>
    <textarea class="form-control @error($field->name) is-invalid @enderror" id="{{ $field->name }}" rows="10" name="{{ $field->name }}" placeholder="{{ $field->label ?? $field->name }}" aria-describedby="{{ $field->name }}-error">
        @if(old($field->name)) {{ old($field->name) }} @else {{ $value }}  @endif
    </textarea>
    @if(isset($field->description))
        <p class="mt-2 text-sm text-gray-500">
            {{ $field->description }}
        </p>
    @endif
    @error($field->name)
    <p class="invalid-feedback" id="{{ $field->name }}-error">{{ $message }}</p>
    @enderror
</div>
