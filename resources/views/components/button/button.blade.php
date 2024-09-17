@props([
    'type' => 'submit',
    'style' => 'primary',
])

<button type="{{ $type }}" class="btn btn-{{ $style }}">
    {{ $slot }}
</button>
