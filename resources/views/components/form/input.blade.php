<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <input
        type="{{ $type }}"
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control"
        value="{{ old($name, $value) }}"
    {{ $required ? 'required' : '' }}
    {{ isset($readonly) && $readonly ? 'readonly' : '' }}
    >
    @error($name)
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
