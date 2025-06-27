<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-900">
                            {{ __("Pages") }}
                        </div>
                        <div class="text-xl font-bold">{{ $totalPages }}</div>
                    </div>
                </div>
                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-900">
                            {{ __("Posts") }}
                        </div>
                        <div class="text-xl font-bold">{{ $totalPosts }}</div>
                    </div>
                </div>
                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-900">
                            {{ __("Categories") }}
                        </div>
                        <div class="text-xl font-bold">{{ $totalCategories }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
