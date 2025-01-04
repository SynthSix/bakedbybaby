@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-5">Edit Item</h2>

    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="item_name" class="block text-gray-700">Item Name</label>
            <input type="text" name="item_name" id="item_name" value="{{ $item->item_name }}" 
                   class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="item_stock" class="block text-gray-700">Stock</label>
            <input type="text" name="item_stock" id="item_stock" value="{{ $item->item_stock }}" 
                   class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="item_tags" class="block text-gray-700">Tags</label>
            <input type="text" name="item_tags" id="item_tags" value="{{ $item->item_tags }}" 
                   class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label for="item_image" class="block text-gray-700">Item Image</label>
            <input type="file" name="item_image" id="item_image" class="w-full px-4 py-2 border rounded-lg">
            @if ($item->item_image)
                <img src="{{ asset('storage/' . $item->item_image) }}" alt="Item Image" class="mt-2 w-32">
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
