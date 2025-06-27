<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Media') }}
        </h2>
    </x-slot>

    <x-container>
        <x-card>
            <div style="width: 100%; height: 700px; border: 1px solid #ddd; overflow: hidden;">
                <iframe src="{{ url('/media-gallery') }}" style="width: 100%; height: 100%; border: none; overflow: hidden;" frameborder="0">
                </iframe>
            </div>
        </x-card>
    </x-container>
</div>
