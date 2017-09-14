<div class="form-group">
    <label for="{{ $field->name() }}">{{ $field->label() }}</label>
    <select class="form-control" name="{{ $field->name() }}" id="{{ $field->name() }}">
        @foreach($field->option() as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
        @endforeach
    </select>
</div>
