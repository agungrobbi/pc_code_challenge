<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <x-container>
        <x-card>
            <x-button primary type="button" wire:click="$dispatch('open-category-modal')">{{ __('Create new category') }}</x-button>

            <div class="mt-4">
                <livewire:category.table />
            </div>
        </x-card>
    </x-container>

    <livewire:category.upsert lazy />
</div>
