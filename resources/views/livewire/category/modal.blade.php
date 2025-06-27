<div>
    <x-modal name="modalCategory">
        <x-slot name="title">
            {{ $category ? __('Edit Category') : __('Create Category') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="save">
                <x-validation.error class="mb-4" :errors="$errors" />

                <div class="grid grid-cols-2 sm:grid-cols-1 gap-4">
                    <div>
                        <x-form.label for="title" :value="__('Title')" />
                        <x-form.input id="title" class="block mt-1 w-full" type="text" wire:model="title"
                            wire:keyup="generateSlug" wire:model="title" required />
                        <x-form.input-error :messages="$errors->get('title')" for="title" class="mt-2" />
                    </div>

                    <div>
                        <x-form.label for="slug" :value="__('Slug')" />
                        <x-form.input id="slug" class="block mt-1 w-full" type="text" wire:model="slug" wire:model="slug" />
                        <x-form.input-error :messages="$errors->get('slug')" for="slug" class="mt-2" />
                    </div>
                </div>

                <div class="w-full py-4">
                    <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                        {{ $category ? __('Edit') : __('Create') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
