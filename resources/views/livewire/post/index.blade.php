<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <x-container>
        <x-card>
            <x-button :href="route('app.post.create')" :active="request()->routeIs('app.post.create')" wire:navigate>
                {{ __('Create new post') }}
            </x-button>

            <div class="mt-4">
                <livewire:post.table />
            </div>
        </x-card>
    </x-container>
</div>
