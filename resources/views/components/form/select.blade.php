@props(['id', 'name', 'options', 'label', 'selected' => [], 'required' => false, 'multiple' => false])

<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <select id="{{ $id }}" name="{{ $name }}" class="form-control" {{ $required ? 'required' : '' }} {{ $multiple ? 'multiple' : '' }}>
        @unless($multiple)
            <option value="">-- Select Option --</option>
        @endunless
        @foreach ($options as $value => $display)
            <option value="{{ $value }}"
                    @if($multiple && is_array(old($name, $selected)) && in_array($value, old($name, $selected)))
                        selected
                    @elseif(!$multiple && $selected == $value)
                        selected
                @endif
            >
                {{ $display }}
            </option>
        @endforeach
    </select>
</div>
