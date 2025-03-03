<div class="bg-white py-3 px-6 flex justify-between items-center shadow-sm sticky top-0 z-10">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Dashboard Overview</h2>
        <p class="text-sm text-gray-500">Welcome back, {{ Auth::user()->name }}!</p>
    </div>
    
    <div class="flex items-center space-x-4">
        <a href="{{ route('expenses.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">
            Add Expense
        </a>
        <button class="rounded-full bg-gray-100 p-2">
            <i class="fas fa-bell text-gray-500"></i>
        </button>
        <button class="rounded-full bg-gray-100 p-2">
            <i class="fas fa-question-circle text-gray-500"></i>
        </button>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-2xl hover:bg-green-600 transition duration-300">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>