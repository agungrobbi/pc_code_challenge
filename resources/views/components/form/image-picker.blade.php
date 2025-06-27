@props([
'id' => 'lfm-input-' . uniqid(),
'name' => 'image_url',
'value' => null,
'label' => 'Select Image',
'type' => 'file',
'routePrefix' => '/media-gallery',
])

@php
$buttonId = $id . '_button';
$previewId = $id . '_holder';
@endphp

<div class="mb-4">
    <div class="flex items-center space-x-2">
        <a id="{{ $buttonId }}" data-input="{{ $id }}" data-preview="{{ $previewId }}"
            class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-200 cursor-pointer">
            Choose Image
        </a>

        <input id="{{ $id }}" name="{{ $name }}" type="text" value="{{ old($name, $value) }}"
            class="block w-full border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-500 sm:text-sm rounded-md text-gray-900 py-2 px-3"
            readonly placeholder="No image selected">
    </div>

    <div id="{{ $previewId }}" style="margin-top:15px;max-height:100px; overflow: hidden;"
        class="flex justify-center items-center p-2 border border-gray-200 rounded-md bg-gray-50">
        @if($value)
        <img src="{{ $value }}" alt="Preview" style="max-height: 100px; max-width: 100%;">
        @else
        <span class="text-gray-400 text-sm">Image preview will appear here</span>
        @endif
    </div>
</div>

@push('scripts')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#{{ $buttonId }}').filemanager('{{ $type }}', { prefix: '{{ $routePrefix }}' });
        Livewire.on('{{ Str::camel($attributes->get('wire:model')) }}Updated', (value) => {
            const previewElement = document.getElementById('{{ $previewId }}');
            if (previewElement) {
                if (value) {
                        previewElement.innerHTML = `<img src="${value}" alt="Preview" style="max-height: 100px; max-width: 100%;">`;
                } else {
                        previewElement.innerHTML = `<span class="text-gray-400 text-sm">Image preview will appear here</span>`;
                }
            }
        });
    });
</script>
@endpush
