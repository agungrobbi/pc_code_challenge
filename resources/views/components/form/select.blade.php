@props([
    'options' => [],
    'placeholder' => null,
    'selected' => null,
    'livewireAttribute' => '',
])

<select
    {{ $attributes->merge([
        'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
        'wire:model' => $livewireAttribute ?: $attributes->get('wire:model'),
    ]) }}
>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif

    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @if((string)$value === (string)$selected) selected @endif>{{ $label }}</option>
    @endforeach
</select>
