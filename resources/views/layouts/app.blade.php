<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MoneyMind</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f9fafb;
                color: #1f2937;
            }
        </style>
    </head>
    <body x-data="{ sidebarOpen: false }">
        <div class="flex min-h-screen">
            <!-- Mobile sidebar backdrop -->
            <div 
                x-show="sidebarOpen" 
                @click="sidebarOpen = false" 
                class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            ></div>
            
            <!-- Sidebar -->
            <x-sidebar />
            
            <!-- Main Content -->
            <div class="flex-1 ml-64">
                @yield('content') <!-- This is where the content of each page will be injected -->
            </div>
        </div>
    </body>
</html>
