@props([
    'id',
    'name',
    'value' => '',
    'label' => '',
])

<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control"
    >{{ $value }}</textarea>
    @error($name)
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
