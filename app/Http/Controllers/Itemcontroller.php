<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    
    public function index()
    {
        // Use Eloquent to get the items
        $items = Item::all();  // This will return a collection of items as objects

        return view('index', compact('items'));
    }

    public function store(Request $request)
    {
        try {
            // Debug the incoming request
            Log::info('Incoming request data:', $request->all());

            $request->validate([
                'item_name' => 'required|string|max:255',
                'item_stock' => 'required|string',               
                'item_tags' => 'nullable|string',
                'item_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            if ($request->hasFile('item_image')) {
                $fileName = $request->file('item_image')->getClientOriginalName();
            
                // Save the file to 'public/storage'
                $request->file('item_image')->move(public_path('storage'), $fileName);
            
                // Save only the file name to the database
                $imagePath = $fileName;
            
                // Log the file name for debugging
                Log::info('File saved to public/storage:', ['file_name' => $imagePath]);
            } else {
                $imagePath = null;
                Log::info('No file uploaded');
            }
            
            

            // Debug data before create
            Log::info('Attempting to create item with data:', [
                'item_name' => $request->item_name,
                'item_stock' => $request->item_stock,
                'item_tags' => $request->item_tags,
                'item_image' => $imagePath,
            ]);

            $item = Item::create([
                'item_name' => $request->item_name,
                'item_stock' => $request->item_stock,
                'item_tags' => $request->item_tags,
                'item_image' => $imagePath,
            ]);

            // Debug successful creation
            Log::info('Item created successfully:', $item->toArray());

            return redirect()->route('items.index')->with('success', 'Item added successfully!');
        } catch (\Exception $e) {
            // Enhanced error logging
            Log::error('Error in store method:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($item_id)
    {
        try {
            $item = Item::findOrFail($item_id);
            return view('items.edit', compact('item'));
        } catch (\Exception $e) {
            Log::error('Error editing item: ', ['message' => $e->getMessage()]);
            return redirect()->route('items.index')->withErrors('Item not found.');
        }
    }

    public function update(Request $request, $item_id)
    {
        try {
            $request->validate([
                'item_name' => 'required|string|max:255',
                'item_stock' => 'required|string',
                'item_tags' => 'nullable|string',
                'item_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            $item = Item::findOrFail($item_id);

            if ($request->hasFile('item_image')) {
                $fileName = $request->file('item_image')->getClientOriginalName();
                $request->file('item_image')->move(public_path('storage'), $fileName);
                $item->item_image = $fileName;
            }

            $item->item_name = $request->item_name;
            $item->item_stock = $request->item_stock;
            $item->item_tags = $request->item_tags;
            $item->save();

            return redirect()->route('items.index')->with('success', 'Item updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating item: ', ['message' => $e->getMessage()]);
            return back()->withErrors('An error occurred while updating the item.');
        }
    }

    public function destroy($item_id)
    {
        try {
            $item = Item::findOrFail($item_id);
            $item->delete();
            return redirect()->route('items.index')->with('success', 'Item deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting item: ', ['message' => $e->getMessage()]);
            return back()->withErrors('An error occurred while deleting the item.');
        }
    }
}