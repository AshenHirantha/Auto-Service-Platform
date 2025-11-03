<div x-data="{ open: false }" class="inline-block">
    <!-- Delete button -->
    <button 
        type="button" 
        @click="open = true"
        class="inline-flex items-center px-3 py-1.5 text-sm font-medium bg-red-500 text-white rounded-md shadow hover:bg-red-600 transition">
        Delete
    </button>

    <!-- Modal backdrop -->
    <div 
        x-show="open" 
        x-cloak
        x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

        <!-- Modal content -->
        <div x-show="open" 
             x-transition
             class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            
            <h2 class="text-lg font-semibold text-gray-800 mb-3">
                Confirm Deletion
            </h2>
            <p class="text-sm text-gray-600 mb-6">
                Are you sure you want to delete 
                <span class="font-semibold">{{ $itemName }}</span>?  
                This action cannot be undone.
            </p>

            <div class="flex justify-end gap-3">
                <!-- Cancel -->
                <button 
                    type="button" 
                    @click="open = false"
                    class="px-4 py-2 text-sm font-medium bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">
                    Cancel
                </button>

                <!-- Confirm Delete -->
                <form action="{{ $route }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                        Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
