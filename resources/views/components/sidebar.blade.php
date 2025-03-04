@php
    use Illuminate\Support\Facades\Auth;
@endphp

<div class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-lg" style="height: 100vh; overflow-y: hidden;">
    <div class="flex flex-col h-full">
        <div class="px-6 pt-8 pb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-[#13314E] to-[#235789] flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-white"></i>
                    </div>
                    <h1 class="text-xl font-bold text-gray-800">MoneyMind</h1>
                </div>
                <button @click="sidebarOpen = false" class="text-gray-600 lg:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        
        <div class="flex-1 px-4 space-y-1 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="nav-item active flex items-center px-4 py-3 text-sm">
                <i class="fas fa-chart-pie w-5 h-5 mr-3 text-gray-600"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('expenses.index') }}" class="nav-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-credit-card w-5 h-5 mr-3 text-gray-600"></i>
                <span>Expenses</span>
            </a>
            <a href="#" class="nav-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-sync-alt w-5 h-5 mr-3 text-gray-600"></i>
                <span>Recurring</span>
            </a>
            <a href="#" class="nav-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-bullseye w-5 h-5 mr-3 text-gray-600"></i>
                <span>Goals</span>
            </a>
            <a href="#" class="nav-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-star w-5 h-5 mr-3 text-gray-600"></i>
                <span>Wishlist</span>
            </a>
        </div>
        
        <div class="p-3 rounded-xl bg-gray-50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-[#13314E] text-white flex items-center justify-center">
                    <span class="font-semibold">{{ substr(Auth::user()->name ?? 'User', 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-medium text-gray-800 truncate">{{ Auth::user()->name ?? 'User' }}</h3>
                    <p class="text-xs text-gray-500">Premium Account</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>