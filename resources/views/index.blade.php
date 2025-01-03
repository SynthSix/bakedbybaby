<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=add" />
</head>

<body class="bg-[#89cedd]">
    <div class="max-w-lg mx-auto mt-10">
        @auth
            <div class="text-center p-6 bg-green-100 border border-green-300 rounded-lg">
                <h2 class="text-xl font-bold text-green-800">You're Logged In</h2>
                <form action="/logout" method="POST" class="mt-4">
                    @csrf
                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Log Out
                    </button>
                </form>
            </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-7xl mt-6">
        @foreach ($items as $item)
            <x-item-card :item="$item" />
        @endforeach
    </div>

    <!-- Add Item Button -->
    <div class="fixed bottom-6 right-6">
        <button
            class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-600"
            id="add-item-button">
            <span class="material-symbols-outlined">add</span>      
        </button>
    </div>

    <!-- Add Item Form -->
    <div id="add-item-form" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded-xl shadow-lg w-1/3">
            <h3 class="text-xl font-semibold mb-4">Add New Item</h3>
            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Item Name -->
                <div class="mb-4">
                    <label for="item_name" class="block text-sm font-medium text-gray-700">Item Name</label>
                    <input type="text" name="item_name" id="item_name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Item Stock -->
                <div class="mb-4">
                    <label for="item_stock" class="block text-sm font-medium text-gray-700">Item stock</label>
                    <textarea name="item_stock" id="item_stock" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <!-- Item Tags -->
                <div class="mb-4">
                    <label for="item_tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input type="text" name="item_tags" id="item_tags" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Item Image -->
                <div class="mb-4">
                    <label for="item_image" class="block text-sm font-medium text-gray-700">Item Image</label>
                    <input type="file" name="item_image" id="item_image" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Add Item
                    </button>
                </div>
            </form>
        </div>
    </div>





        @else
            <div class="p-6 bg-gray-100 border border-gray-300 rounded-lg">
                <!-- Registration Form -->
                <h2 class="text-xl font-bold text-gray-800 mb-4">Register</h2>
                <form action="/register" method="POST" class="space-y-4">
                    @csrf
                    <input name="name" type="text" placeholder="Name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input name="email" type="email" placeholder="Email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input name="password" type="password" placeholder="Password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button
                        class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400">
                        Register
                    </button>
                </form>
            </div>

            <!-- Login Form -->
            <div class="p-6 bg-gray-100 border border-gray-300 rounded-lg mt-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Login</h2>
                <form action="/login" method="POST" class="space-y-4">
                    @csrf
                    <input name="loginemail" type="email" placeholder="Email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input name="loginpassword" type="password" placeholder="Password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button
                        class="w-full px-4 py-2 bg-[#00d0ff] text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-green-400">
                        Login
                    </button>
                </form>
            </div>
        @endauth
    

    <!-- Product Modal -->
    <div id="productModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Product Details</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="modalContent">
                        <!-- Content will be inserted here -->
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeModal" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        //Modal Product Details
        function showModal(name, tags, stock, image, id) {
        // Populate modal with item data
        document.getElementById('modalItemName').textContent = name;
        document.getElementById('modalItemTags').textContent = tags;
        document.getElementById('modalItemStock').textContent = stock;
        document.getElementById('modalItemImage').src = image;

        // Store the item ID for update/delete actions
        document.getElementById('itemModal').dataset.itemId = id;

        // Show modal
        document.getElementById('itemModal').classList.remove('hidden');
        }

        function closeModal() {
            // Hide modal
            document.getElementById('itemModal').classList.add('hidden');
        }

        function editItem() {
            const itemId = document.getElementById('itemModal').dataset.itemId;
            // Redirect to edit page or send AJAX request
            window.location.href = `/items/${itemId}/edit`;
        }

        function deleteItem() {
            const itemId = document.getElementById('itemModal').dataset.itemId;
            // Send delete request (you may use fetch/axios for better handling)
            if (confirm('Are you sure you want to delete this item?')) {
                fetch(`/items/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        location.reload(); // Reload page on successful delete
                    } else {
                        alert('Failed to delete item.');
                    }
                });
            }
        }

        //Prompt button is clicked
        document.getElementById('add-item-button').addEventListener('click', function () {
        // Toggle visibility of the add item form
        const form = document.getElementById('add-item-form');
        form.classList.toggle('hidden');
        });


    </script>
</body>

</html>