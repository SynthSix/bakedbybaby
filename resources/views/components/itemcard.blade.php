<div>
    <!-- Item Card -->
    <div class="flex flex-col sm:flex-row rounded-xl bg-white shadow-md p-4 mb-4">
        <div class="relative w-full sm:w-2/5 overflow-hidden rounded-xl bg-gray-100">
            <img src="{{ asset('storage/' . $item->item_image) }}" 
                 alt="{{ $item->item_name }}" 
                 class="h-48 sm:h-full w-full object-cover cursor-pointer"
                 onclick="showModal('{{ $item->item_name }}', '{{ $item->item_tags }}', '{{ $item->item_stock }}', '{{ asset('storage/' . $item->item_image) }}', '{{ $item->id }}')">
        </div>
        <div class="p-4 flex-grow">
            <h4 class="text-lg font-bold text-gray-800 mb-2 cursor-pointer"
                onclick="showModal('{{ $item->item_name }}', '{{ $item->item_tags }}', '{{ $item->item_stock }}', '{{ asset('storage/' . $item->item_image) }}', '{{ $item->id }}')">
                {{ $item->item_name }}
            </h4>
            <p class="text-sm text-gray-600 mb-2">{{ $item->item_stock }}</p>
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach (explode(',', $item->item_tags) as $tag)
                    <span class="px-3 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">{{ trim($tag) }}</span>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="itemModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-lg p-6 relative">
            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
                &times;
            </button>
            <!-- Modal Content -->
            <h3 class="text-xl font-semibold mb-4" id="modalItemName"></h3>
            <img src="" alt="Item Image" id="modalItemImage" class="h-48 w-full object-cover mb-4">
            <p class="text-sm text-gray-600 mb-2">
                <strong>Tags:</strong> <span id="modalItemTags"></span>
            </p>
            <p class="text-sm text-gray-600 mb-2">
                <strong>Stock:</strong> <span id="modalItemStock"></span>
            </p>
            <div class="flex justify-end mt-4">
                <!-- Update Button -->
                <button class="bg-blue-600 text-white px-4 py-2 rounded mr-2" onclick="editItem()">
                    Update
                </button>
                <!-- Delete Button -->
                <button class="bg-red-600 text-white px-4 py-2 rounded" onclick="deleteItem()">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
