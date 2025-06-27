<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
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

                    <div>
                        <x-form.label for="categories" :value="__('Categories')" />
                        <select
                            id="categories"
                            multiple
                            wire:model="selectedCategories"
                            class="block mt-1 w-full border-gray-100 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-500 sm:text-sm rounded-md text-green-900"
                        >
                            @foreach($allCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <x-form.input-error :messages="$errors->get('selectedCategories')" for="selectedCategories" class="mt-2" />
                    </div>

                    <div>
                        <x-form.label for="image" :value="__('Image')" />
                        <x-form.image-picker
                            id="banner_image"
                            name="banner_url"
                            wire:model="image"
                        />
                        <x-form.input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>

                    <div>
                        <x-form.label for="excerpt" :value="__('Excerpt')" />
                        <x-form.textarea id="excerpt" class="block mt-1 w-full"
                            wire:model="excerpt" />
                        <x-form.input-error :messages="$errors->get('excerpt')" for="excerpt" class="mt-2" />
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <x-form.label for="content" :value="__('Content')" />
                        <x-form.wysiwyg wire:model="content" class="mt-1" />
                        <x-form.input-error :messages="$errors->get('content')" for="content" class="mt-2" />
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
