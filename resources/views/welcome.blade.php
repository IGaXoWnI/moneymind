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
        <style>
            body {
                font-family: 'Avenir Next', sans-serif; /* Set the font family */
            }
            .typed {
                border-right: 2px solid; /* Cursor effect */
                animation: blink 0.7s infinite; /* Blinking effect */
            }
            @keyframes blink {
                50% {
                    border-color: transparent; /* Blink effect */
                }
            }
            .custom-text {
                color: #686868; /* Custom text color */
                font-size: 18px; /* Font size */
                font-weight: 400; /* Set font weight to 400 (regular) */
                line-height: 1.5; /* Improved line height for readability */
            }
            .hero-image {
                width: 80%; /* Increased image width to 80% */
                margin: 20px auto 0; /* Center the image and add top margin for spacing */
                display: block; /* Ensure the image is treated as a block element */
            }
            .main-heading {
                color: #13314E; /* Set heading color */
                font-size: 56px; /* Set font size */
                font-weight: 500; /* Set font weight to 500 */
            }
            main {
                height: 120vh; /* Set main section height to 120vh */
            }
        </style>
    </head>
    <body class="bg-gray-50 text-gray-800 font-sans">
        <header class="bg-[#F5F5F5] shadow-lg">
            <nav class="container mx-auto flex justify-between items-center p-4">
                <div class="text-2xl font-bold text-green-500">MoneyMind</div>
                <div>
                    <a href="{{ route('login') }}" class="bg-green-500 text-white px-4 py-2 rounded-2xl hover:bg-green-600 transition duration-300">Get Started</a>
                </div>
            </nav>
        </header>

        <main>
            <!-- Hero Section -->
            <section class="flex items-center justify-center text-center bg-[#F5F5F5] h-full">
                <div class="max-w-2xl">
                    <h1 class="main-heading mb-4">
                        Driving Smarter Decision-Making
                        <span class="typed">With Research Reports</span>
                    </h1>
                    <p class="custom-text mb-6">Let data be your guide as you make business decisions. Navigate the future through data-driven intelligence.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#what-we-do" class="bg-[#13304E] text-white px-6 py-3 rounded-2xl shadow-lg hover:bg-[#0f2a3c] transition duration-300">What We Do</a>
                        <a href="#see-all-reports" class="bg-[#FFDE5A] text-black px-6 py-3 rounded-2xl shadow-lg hover:bg-[#ffd54f] transition duration-300">See All Reports</a>
                    </div>
                    <!-- Image under the buttons -->
                    <img src="https://cdn.prod.website-files.com/6655bdbdbc6ea76005b52a5b/66f536668fbc5fb416c157f4_IntelSense%20-%20New%20Hero%20Image-p-2000.webp" alt="Hero Image" class="hero-image" />
                </div>
            </section>

    
        </main>

        <footer class="py-6 text-center bg-white shadow-lg">
            <p class="text-gray-600">&copy; 2023 MoneyMind. All rights reserved.</p>
        </footer>
    </body>
</html>
