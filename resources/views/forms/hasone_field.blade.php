<div class="mb-3 col-md-{{ $field->col ?? '12' }}">
    <label for="{{ $field->name }}" class="form-label">{{ $field->label ?? $field->name }}</label>
    <select class="form-control @error($field->name) is-invalid @enderror" id="{{ $field->name }}" name="{{ $field->name }}" aria-describedby="{{ $field->name }}-error">
        <option>None</option>
        @foreach($field->relations as $relation)
            <option value="{{ $relation->id }}" @if(old($field->name) == $relation->id || $value == $relation->id) selected="selected"  @endif>{{ $relation->name }}</option>
        @endforeach
    </select>
    @if(isset($field->description))
        <p class="mt-2 text-sm text-gray-500">
            {{ $field->description }}
        </p>
    @endif
    @error($field->name)
        <p class="invalid-feedback" id="{{ $field->name }}-error">{{ $message }}</p>
    @enderror
</div>
