<div class="flex space-x-2">
    <a href="{{ route('app.post.edit', ['post' =>  $row->id]) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
    <button wire:click="$dispatch('do-post-delete', { id: {{ $row->id }} })" wire:confirm="{{ __('Are you sure you want to delete this post?') }}" class="text-red-600 hover:text-red-900">Delete</button>
</div>
