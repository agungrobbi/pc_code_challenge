<div class="flex space-x-2">
    <a href="{{ route('app.page.edit', ['page' =>  $row->id]) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
    <button wire:click="$dispatch('do-page-delete', { id: {{ $row->id }} })" wire:confirm="{{ __('Are you sure you want to delete this page?') }}" class="text-red-600 hover:text-red-900">Delete</button>
</div>
