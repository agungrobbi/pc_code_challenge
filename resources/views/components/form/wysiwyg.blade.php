@props(['id' => 'trix-editor-' . uniqid(), 'value' => ''])

<div
    wire:ignore
    x-data="{
        value: @entangle($attributes->wire('model')),
        editorInstance: null,
        isUpdatingFromExternal: false,
        init() {
            const hiddenInput = document.getElementById('{{ $id }}');
            const trixEditorElement = this.$refs.trixEditor;

            trixEditorElement.addEventListener('trix-initialize', (event) => {
                setTimeout(() => {
                    this.editorInstance = trixEditorElement.editor;

                    if (!this.editorInstance) {
                        return;
                    }

                    if (this.value) {
                        this.editorInstance.loadHTML(this.value);
                    }

                    trixEditorElement.addEventListener('trix-change', (e) => {
                        if (!this.isUpdatingFromExternal) {
                            this.value = e.target.value;
                            hiddenInput.value = e.target.value;
                        }
                    });

                }, 0);
            });

            this.$watch('value', (newValue) => {
                if (this.editorInstance && !this.isUpdatingFromExternal) {
                    const currentHTML = trixEditorElement.value;

                    if (currentHTML !== newValue) {
                        this.isUpdatingFromExternal = true;
                        this.editorInstance.loadHTML(newValue || '');
                        setTimeout(() => {
                            this.isUpdatingFromExternal = false;
                        }, 50);
                    }
                }
            });
        }
    }"
    x-init="init()"
>
    <input
        id="{{ $id }}"
        type="hidden"
        name="{{ $attributes->wire('model')->value() }}"
        value="" {{-- This 'value' attribute will be controlled by Trix/Alpine --}}
    >

    <trix-editor
        input="{{ $id }}"
        x-ref="trixEditor"
        class="{{ $attributes->get('class') }} trix-content mt-1 block w-full"
    ></trix-editor>
</div>
