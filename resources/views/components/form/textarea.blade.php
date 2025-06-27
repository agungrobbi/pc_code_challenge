@props([
    'id' => null,
    'name' => null,
    'value' => null,
    'disabled' => false,
    'required' => false,
    'placeholder' => null,
    'autofocus' => false,
    'rows' => 5,
    'autocomplete' => null,
    'readonly' => false,
])

@php
    $attributes = $attributes->class([
        'border-gray-100 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-500 block w-full sm:text-sm rounded-md text-green-900',
        'disabled:opacity-50' => $disabled,
        'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red-500' => $errors->has($name),
    ])->merge([
        'id' => $id,
        'name' => $name,
        'disabled' => $disabled,
        'required' => $required,
        'placeholder' => $placeholder,
        'autofocus' => $autofocus,
        'rows' => $rows,
        'autocomplete' => $autocomplete,
        'readonly' => $readonly,
    ]);
@endphp

<textarea {{ $attributes }}>{{ $value }}</textarea>
