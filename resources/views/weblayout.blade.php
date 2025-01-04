<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layout Experiment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    
</head>
<body class="h-screen flex flex-col">
    {{-- Navbar --}}
    <nav class="bg-[#00d0ff] text-white p-4 flex justify-between items-center">
        <button id="menuButton" class="p-2 hover:bg-white-600 rounded-lg transition-colors">
            <span class="material-symbols-outlined">
                menu
            </span>
        </button>

        <span class="ml-2">
           Baked By Baby
        </span>
        
        <span class="material-symbols-outlined">
            account_circle
        </span>
    </nav>
    
    {{-- Main Content Area --}}
    <div class="flex flex-1 relative">
        {{-- Overlay for clicking outside to close sidebar --}}
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden"></div>

        {{-- Sidebar --}}
        <aside id="sidebar" class="bg-gray-500 text-white p-4 w-64 fixed top-[4.8rem] bottom-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out z-30 overflow-y-auto border-r-2 border-gray-900"> 
            Sidebar Content
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col bg-gray-100 p-4 transition-all duration-300">            
            <div class="flex-1 bg-gray-100 p-4 border-2 border-x-gray-300">Main Content</div>
        
            {{-- Footer --}}
            <footer class="flex border-2 border-red-500 p-4">
                <div class="border-2 border-blue-500 p-4">Box 1</div>
                <div class="border-2 border-green-400 p-4 flex-1">Box 2</div>
                <div class="border-2 border-yellow-500 p-4">Box 3</div>
            </footer>
        </main>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuButton = document.getElementById("menuButton");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        function toggleSidebar() {
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }

        menuButton.addEventListener("click", toggleSidebar);
        overlay.addEventListener("click", toggleSidebar);
    });

    // In your script
    function toggleSidebar() {
        sidebar.classList.toggle("-translate-x-full");
        overlay.classList.toggle("hidden");
        document.querySelector('main').classList.toggle('md:ml-64');
    }
</script>
</body>
</html>