<div>
    <!-- Item Card -->
    <div class="flex flex-col sm:flex-row rounded-xl bg-white shadow-md p-4 mb-4">
        <div class="relative w-full sm:w-2/5 overflow-hidden rounded-xl bg-gray-100">
            <img src="{{ asset('storage/' . $item->item_image) }}" 
                 alt="{{ $item->item_name }}" 
                 class="h-48 sm:h-full w-full object-cover cursor-pointer"
                 onclick="showModal('{{ $item->item_name }}', '{{ $item->item_tags }}', '{{ $item->item_stock }}', '{{ asset('storage/' . $item->item_image) }}', '{{ $item->item_id }}')">
        </div>
        <div class="p-4 flex-grow">
            <h4 class="text-lg font-bold text-gray-800 mb-2 cursor-pointer"
                onclick="showModal('{{ $item->item_name }}', '{{ $item->item_tags }}', '{{ $item->item_stock }}', '{{ asset('storage/' . $item->item_image) }}', '{{ $item->item_id }}')">
                {{ $item->item_name }}
            </h4>
            <p class="text-sm text-gray-600 mb-2">{{ $item->item_stock }}</p>
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach (explode(',', $item->item_tags) as $tag)
                    <span class="px-3 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">{{ trim($tag) }}</span>
                @endforeach
            </div>
            <div class="mt-auto align-left">
                <h6 class="text-sm font-semibold mb-2">Recent Updates:</h6>
                <div class="space-y-1">
                    <p class="text-xs text-gray-600">• {{ $item->item_history_logs }}</p>
                </div>
            </div>
        </div>
        
    </div>

    
</div>
