<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=add" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

</head>

<body class="h-screen flex flex-col bg-[#89cedd]">
                   
    @auth

    {{-- Navbar --}}
    <nav class="bg-[#35cbcc] fixed top-0 left-0 right-0 text-white p-4  z-30 flex justify-between items-center border-b-2 border-black-900">
        {{-- Menu Button --}}

        <button id="menuButton" class="p-2 hover:bg-white-600 rounded-lg transition-colors flex items-center">
            <span class="material-symbols-outlined">
                menu
            </span>
            <span class="ml-2 text-s font-bold">
                Baked By Baby
            </span>
        </button>


        {{-- //Logo --}}
        <div class="flex w-12 h-12">
            <img src="../storage/BakedByBabyLogo.jpg" alt="Logo">
        </div>
        
        <div>
            <span class="material-symbols-outlined mr-2">
                notifications
            </span>
            <span class="material-symbols-outlined">
                account_circle
            </span>
        </div>
    </nav>
    
    {{-- Main Content Area --}}
    <div class="flex flex-1 relative">
        {{-- Overlay for clicking outside to close sidebar --}}
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-10 z-20 hidden md:hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="bg-[#b6e4e4] text-[#5c5959] text-2xl p-4 w-64 fixed top-[5rem] bottom-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out z-30 overflow-y-auto border-r-1 border-gray-400">            
            <div class="flex items-center space-x-2 mb-4 ">
                <span class="material-symbols-outlined ">
                    dashboard
                </span>
                <h2 class="font-bold">Dashboard</h2>
            </div>
            <div class="flex items-center space-x-2 mb-4">
                <span class="material-symbols-outlined">
                    Inventory
                </span>
                <h2 class="font-bold">Inventory</h2>
            </div>
            <div class="flex items-center space-x-2 mb-4">
                <span class="material-symbols-outlined">
                    Analytics
                </span>
                <h2 class="font-bold">Analytics</h2>
            </div>

            <div class="flex items-center space-x-2 mb-4">
                <span class="material-symbols-outlined">
                    Group
                </span>
                <h2 class="font-bold">Staffs</h2>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col pt-20 bg-gray-100 p-4 transition-all duration-300">            
            <div class="flex-1 bg-gray-100 p-4">
                {{-- Main Content --}}

                <!-- Filters for inventory -->
                <nav class="flex justify-between items-center m-1 ml-0 mr-0 border-gray-300 text-gray-600">
                    <!-- Search -->
                    <div class="flex fitems-center m-1 ml-0 border-2 rounded bg-gray-200 drop-shadow">
                        <span class="material-symbols-outlined mr-2">
                            search
                        </span>
                        <input type="text" placeholder="Search" class="bg-transparent focus:outline-none">
                    </div>

                    <div class="flex flex-1 "></div>
                    <div>
                        <span class="material-symbols-outlined mr-.5 border-2 rounded bg-gray-200 drop-shadow">
                            filter_alt
                        </span>
                        <span class="material-symbols-outlined mr-0  border-2 rounded bg-gray-200 drop-shadow">
                            sort
                        </span>
                    </div>
                    <div></div>
                    <div></div>
                </nav>

                <!-- Inventory Items -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-7xl mt-6">
                    @foreach ($items as $item)
                        <x-item-card :item="$item" />
                    @endforeach
                </div>

                <!-- Log Out -->
                <div class="max-w-lg mx-auto mt-10">
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

                <!-- Footer -->
                <footer class="flex border-2 border-red-500 p-4">
                    <div class="border-2 border-blue-500 p-4">Footer </div>
                    <div class="border-2 border-green-400 p-4 flex-1">Eperiment Layout</div>
                    <div class="border-2 border-yellow-500 p-4">Box 3</div>
                </footer>

                <!-- Add Item Button -->
                <div class="fixed bottom-6 right-6">
                    <button
                        class="bg-[#89cedd] text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-600"
                        id="add-item-button">
                        <span class="material-symbols-outlined">add</span>      
                    </button>
                </div>
                
                <!-- Add Item Form -->
                <div id="add-item-form" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md justify-center">
                        <div class="flex justify-between items-center >
                            <h3 class="flex text-xl mb-6 font-bold ">Add New Item</h3>
                            <button onclick="closeModal()" class="text-[8px] bg-gray-500 px-0.5 py-0.5 pb-0 text-white rounded-md hover:bg-gray-600">
                                <span class="material-symbols-outlined text-xs">
                                    close
                                </span>
                            </button>
                        </div>
                        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Item Name -->
                            <div class="mb-4 mt-4">
                                <label for="item_name" class="block text-sm font-medium text-gray-700">Item Name</label>
                                <input type="text" name="item_name" id="item_name" required class="mt-1 block w-full border-gray-700 border-1.5 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
                
                <!-- Item Modal -->
                <div id="itemModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                    <div class="relative mx-auto p-5 border w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl shadow-lg rounded-md bg-white mt-20 md:mt-40 lg:mt-60">                    <div class="mt-3">
                            <h3 class="text-lg font-semibold mb-4" id="modalItemName"></h3>
                            
                            <!-- Item Image -->
                            <img id="modalItemImage" src="" alt="Item Image" class="w-full h-full object-cover rounded-lg mb-4 hidden">
                            
                            <!-- Item Details -->
                            <div class="mb-4">
                                <p class="text-gray-600">Stock: <span id="modalItemStock"></span></p>
                                <p class="text-gray-500 text-sm">Tags: <span id="modalItemTags"></span></p>
                            </div>
                
                            <!-- Action Buttons -->
                            <div class="flex justify-end space-x-2">
                                <button onclick="editItem()" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    Edit
                                </button>
                                <button onclick="deleteItem()" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                    Delete
                                </button>
                                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Edit Form Modal -->
                <div id="editFormModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <h3 class="text-lg font-semibold mb-4">Edit Item</h3>
                        <form id="editItemForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Item Name</label>
                                <input type="text" id="edit_item_name" name="item_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="text" id="edit_item_stock" name="item_stock" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Tags</label>
                                <input type="text" id="edit_item_tags" name="item_tags" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">New Image</label>
                                <input type="file" name="item_image" accept="image/*" class="mt-1 block w-full">
                            </div>
                
                            <div class="flex justify-end space-x-2">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    Save Changes
                                </button>
                                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            
        </main>
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
                
            
          
    

<script>
    function closeModal() {
    // Hide the item modal
    const itemModal = document.getElementById('itemModal');
    const additemform = document.getElementById('add-item-form');
    if (itemModal) {
        itemModal.classList.add('hidden');
        additemform.classList.add('hidden');
    }
    }

    function closeEditModal() {
        // Hide the edit form modal
        const editFormModal = document.getElementById('editFormModal');
        if (editFormModal) {
            editFormModal.classList.add('hidden');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
    const menuButton = document.getElementById("menuButton");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const mainContent = document.querySelector('main');
    let isSidebarOpen = true; // Track sidebar state

    function toggleSidebar() {
        isSidebarOpen = !isSidebarOpen;
        
        if (window.innerWidth < 768) {  // mobile behavior
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        } else {  // desktop behavior
            if (isSidebarOpen) {
                sidebar.classList.remove("-translate-x-full");
                mainContent.classList.add("md:ml-64");
            } else {
                sidebar.classList.add("-translate-x-full");
                mainContent.classList.remove("md:ml-64");
            }
        }
    }

    menuButton.addEventListener("click", toggleSidebar);
    overlay.addEventListener("click", toggleSidebar);

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            overlay.classList.add("hidden");
            if (isSidebarOpen) {
                mainContent.classList.add("md:ml-64");
                sidebar.classList.remove("-translate-x-full");
            }
        } else {
            mainContent.classList.remove("md:ml-64");
            if (!isSidebarOpen) {
                sidebar.classList.add("-translate-x-full");
            }
        }
    });
    });

    function showModal(name, tags, stock, image, item_id) {
        // Populate modal with item data
        document.getElementById('modalItemName').textContent = name;
        document.getElementById('modalItemTags').textContent = tags || 'No tags';
        document.getElementById('modalItemStock').textContent = stock;
        
        const modalImage = document.getElementById('modalItemImage');
        if (image) {
            modalImage.src = image;
            modalImage.classList.remove('hidden');
        } else {
            modalImage.classList.add('hidden');
        }

        // Store the item_id in the modal
        document.getElementById('itemModal').dataset.itemId = item_id;

        // Show modal
        document.getElementById('itemModal').classList.remove('hidden');
    }

    function editItem() {
        const item_id = document.getElementById('itemModal').dataset.itemId;
        
        if (!item_id) {
            console.error('No item ID found');
            alert('Error: Item ID not found');
            return;
        }

        const itemName = document.getElementById('modalItemName').textContent;
        const itemTags = document.getElementById('modalItemTags').textContent;
        const itemStock = document.getElementById('modalItemStock').textContent;

        // Populate edit form
        document.getElementById('edit_item_name').value = itemName;
        document.getElementById('edit_item_tags').value = itemTags === 'No tags' ? '' : itemTags;
        document.getElementById('edit_item_stock').value = itemStock;

        // Update form action with proper URL
        const editForm = document.getElementById('editItemForm');
        editForm.action = `/items/${item_id}`;
        
        // Hide view modal and show edit modal
        document.getElementById('itemModal').classList.add('hidden');
        document.getElementById('editFormModal').classList.remove('hidden');
    }

    function deleteItem() {
        const item_id = document.getElementById('itemModal').dataset.itemId;
        
        if (!item_id) {
            console.error('No item ID found');
            alert('Error: Item ID not found');
            return;
        }
        
        if (confirm('Are you sure you want to delete this item?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/items/${item_id}`;

            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Add method spoofing
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
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