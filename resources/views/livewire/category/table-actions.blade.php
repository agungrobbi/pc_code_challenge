<div class="flex space-x-2">
    <button wire:click="$dispatch('open-category-modal', { id: {{ $row->id }} })" class="text-blue-600 hover:text-blue-900">Edit</button>
    <button wire:click="$dispatch('do-category-delete', { id: {{ $row->id }} })" wire:confirm="{{ __('Are you sure you want to delete this post?') }}" class="text-red-600 hover:text-red-900">Delete</button>
</div>
