<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Page') }}
        </h2>
    </x-slot>

    <x-container>
        <x-card>
            <x-button :href="route('app.page.create')" :active="request()->routeIs('app.page.create')" wire:navigate>
                {{ __('Create new Page') }}
            </x-button>

            <div class="mt-4">
                <livewire:page.table />
            </div>
        </x-card>
    </x-container>
</div>
