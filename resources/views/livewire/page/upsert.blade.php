<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Page') }}
        </h2>
    </x-slot>

    <x-container>
        <x-card>
            <form wire:submit.prevent="save">
                <x-validation.error class="mb-4" :errors="$errors" />

                <div class="grid grid-cols-2 sm:grid-cols-1 gap-4">
                    <div>
                        <x-form.label for="title" :value="__('Title')" />
                        <x-form.input id="title" class="block mt-1 w-full" type="text"
                            wire:model="title" wire:keyup="generateSlug" required />
                        <x-form.input-error :messages="$errors->get('title')" for="title" class="mt-2" />
                    </div>

                    <div>
                        <x-form.label for="slug" :value="__('Slug')" />
                        <x-form.input id="slug" class="block mt-1 w-full" type="text"
                            wire:model="slug" />
                        <x-form.input-error :messages="$errors->get('slug')" for="slug" class="mt-2" />
                    </div>

                    <div>
                        <x-form.label for="status" :value="__('Status')" />
                        <x-form.select id="status" class="block mt-1 w-full" type="text" wire:model="status"
                            :options="$this->contentStatusOptions" />
                        <x-form.input-error :messages="$errors->get('status')" for="status" class="mt-2" />
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <x-form.label for="body" :value="__('Content')" />
                        <x-form.wysiwyg wire:model="body" class="mt-1" />
                        <x-form.input-error :messages="$errors->get('body')" for="body" class="mt-2" />
                    </div>
                </div>

                <div class="w-full py-4">
                    <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-card>
    </x-container>
</div>
