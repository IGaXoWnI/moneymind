<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MoneyMind - Personal Budget Management</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        @endif
    </head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <header class="bg-white shadow-lg">
        <nav class="container mx-auto flex justify-between items-center p-4">
            <div class="text-2xl font-bold text-green-500">MoneyMind</div>
            <div>
                <a href="#signup" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">Get Started</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="flex items-center justify-center text-center bg-gradient-to-r from-green-400 to-blue-500 text-white h-[80vh]">
            <div class="max-w-2xl">
                <h1 class="text-6xl font-extrabold mb-4">Take Control of Your Finances</h1>
                <p class="text-2xl mb-6">AI-powered suggestions, automated tracking, and smart alerts for simplified budget management.</p>
                <a href="/register" class="bg-white text-green-500 px-6 py-3 rounded shadow-lg hover:bg-gray-200 transition duration-300">Get Started</a>
            </div>
        </section>

        <section class="py-12 text-center">
            <h2 class="text-4xl font-semibold mb-6">How It Works</h2>
            <p class="mb-4 text-lg">Follow these simple steps to start managing your finances effectively.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="step p-4 border rounded-lg shadow-md bg-white transition-transform transform hover:scale-105">
                    <h3 class="font-medium text-xl">1. Sign Up</h3>
                    <p>Create your account and connect your financial data.</p>
                </div>
                <div class="step p-4 border rounded-lg shadow-md bg-white transition-transform transform hover:scale-105">
                    <h3 class="font-medium text-xl">2. Set Goals</h3>
                    <p>Define your financial goals and budgets.</p>
                </div>
                <div class="step p-4 border rounded-lg shadow-md bg-white transition-transform transform hover:scale-105">
                    <h3 class="font-medium text-xl">3. Get Insights</h3>
                    <p>Receive personalized insights and alerts to stay on track.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-6 text-center bg-white shadow-lg">
        <p class="text-gray-600">&copy; 2023 MoneyMind. All rights reserved.</p>
    </footer>
    </body>
</html>
