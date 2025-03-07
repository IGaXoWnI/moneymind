@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-rose-50 to-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Title Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center">
                <div class="relative">
                    <div class="relative px-7 py-4 leading-none flex items-center">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-indigo-600 to-purple-700 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </span>
                        <span class="font-extrabold text-4xl ml-4 text-gray-900">
                            Wish<span class="text-rose-600">list</span>
                        </span>
                    </div>
                </div>
            </div>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-600">
                Save up for the things you love, one step at a time
            </p>
        </div>

        <!-- Add New Item and Summary Row -->
        <div class="flex flex-col md:flex-row gap-5 mb-10">
            <!-- Summary Card -->
            <div class="md:w-2/3 bg-white rounded-xl shadow-md p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-900">My Wishlist Summary</h2>
                    <span class="bg-rose-100 text-rose-800 text-sm font-medium px-3 py-1 rounded-full">
                        {{ $totalItems }} Items
                    </span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-sm text-gray-500">Total Wishlist Value</div>
                        <div class="text-lg font-bold text-gray-900 mt-1">{{ number_format($totalWishlistValue, 2) }} DH</div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-sm text-gray-500">Total Saved</div>
                        <div class="text-lg font-bold text-gray-900 mt-1">{{ number_format($totalSaved, 2) }} DH</div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-sm text-gray-500">Monthly Contribution</div>
                        <div class="text-lg font-bold text-gray-900 mt-1">{{ number_format($monthlyContribution, 2) }} DH</div>
                    </div>
                </div>

                @if($totalSaved > 0 && $totalWishlistValue > 0)
                <div class="mt-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Overall Progress</span>
                        <span class="text-sm font-medium text-rose-600">
                            {{ number_format(min(($totalSaved / $totalWishlistValue) * 100, 100), 1) }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-gradient-to-r from-rose-500 to-pink-500 h-2.5 rounded-full" 
                            style="width: {{ min(($totalSaved / $totalWishlistValue) * 100, 100) }}%">
                        </div>
                    </div>
                </div>
                @endif
            </div>

   
            <div class="md:w-1/3 bg-gradient-to-br from-rose-500 to-pink-600 rounded-xl shadow-md p-6">
                <h2 class="text-lg font-bold mb-4 text-black">Add to Wishlist</h2>
                <form action="{{ route('wishlist.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-black mb-1">Item Name</label>
                        <input type="text" name="name" id="name" required 
                            class=" p-2 block w-full bg-white bg-opacity-100 border border-transparent rounded-lg 
                            focus:ring-white focus:border-white text-gray-900 placeholder-gray-500 text-sm" 
                            placeholder="What do you wish to buy?">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-black mb-1">Price (DH)</label>
                            <input type="number" name="price" id="price" min="0" step="0.01" required 
                                class="p-2 block w-full bg-white bg-opacity-100 border border-transparent rounded-lg 
                                focus:ring-white focus:border-white text-gray-900 placeholder-gray-500 text-sm" 
                                placeholder="0.00">
                        </div>
                        <div>
                            <label for="monthly_contribution" class="block text-sm font-medium text-black mb-1">Monthly (DH)</label>
                            <input type="number" name="monthly_contribution" id="monthly_contribution" min="0" step="0.01" required 
                                class="p-2 block w-full bg-white bg-opacity-100 border border-transparent rounded-lg 
                                focus:ring-white focus:border-white text-gray-900 placeholder-gray-500 text-sm" 
                                placeholder="0.00">
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full text-white py-2 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg font-medium 
                        hover:bg-opacity-90 transition-colors duration-200 mt-2">
                        Add to Wishlist
                    </button>
                </form>
            </div>
        </div>

        <!-- Wishlist Items Grid -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">My Wishlist</h2>
            
            @if(count($wishlistItems) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($wishlistItems as $item)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <!-- Card Header with Image or Color -->
                        <div class="h-36 bg-gradient-to-r from-rose-100 to-pink-100 relative overflow-hidden">
                            @if($item->image_url)
                                <img class="w-full h-full object-cover" src="{{ $item->image_url }}" alt="{{ $item->name }}">
                            @else
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-rose-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $item->saved_amount >= $item->estimated_cost ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $item->saved_amount >= $item->estimated_cost ? 'Ready to Buy' : 'Saving Up' }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Card Content -->
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->item_name }}</h3>
                            <div class="flex items-center justify-between mb-4">
                                <div class="text-sm text-gray-600">
                                    Added {{ $item->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-rose-600 font-bold">
                                    {{ number_format($item->estimated_cost, 2) }} DH
                                </div>
                            </div>
                            
                            <!-- Progress Bar -->
                            <div class="relative pt-1">
                                <div class="flex mb-2 items-center justify-between">
                                    <div>
                                        <span class="text-xs font-semibold inline-block text-rose-600">
                                            @if($item->estimated_cost > 0)
                                                {{ number_format(min(($item->saved_amount / $item->estimated_cost) * 100, 100), 1) }}%
                                            @else
                                                0%
                                            @endif
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-semibold inline-block text-gray-600">
                                            {{ number_format($item->saved_amount, 2) }} / {{ number_format($item->estimated_cost, 2) }} DH
                                        </span>
                                    </div>
                                </div>
                                <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                                    <div style="width: {{ $item->estimated_cost > 0 ? min(($item->saved_amount / $item->estimated_cost) * 100, 100) : 0 }}%" 
                                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-rose-500 to-pink-500">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Monthly & Time Remaining -->
                            <div class="mt-4 flex justify-between text-sm">
                                <div class="flex items-center text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ number_format($item->monthly_contribution, 2) }} DH monthly
                                </div>
                                
                                @php
                                    $remaining = $item->estimated_cost - $item->saved_amount;
                                    $monthsRemaining = $item->monthly_contribution > 0 ? ceil($remaining / $item->monthly_contribution) : 0;
                                @endphp
                                
                                <div class="flex items-center {{ $monthsRemaining > 0 ? 'text-gray-600' : 'text-green-600' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @if($monthsRemaining > 0)
                                        {{ $monthsRemaining }} {{ Str::plural('month', $monthsRemaining) }} left
                                    @else
                                        Ready to buy!
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 bg-white rounded-xl shadow-md">
                    <div class="mx-auto h-24 w-24 rounded-full bg-rose-100 flex items-center justify-center mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Your wishlist is empty</h3>
                    <p class="text-gray-600 max-w-sm mx-auto mb-6">Start adding items you wish to purchase! Set monthly contributions to save up automatically.</p>
                    <button type="button" onclick="openAddWishModal()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add First Wish
                    </button>
                </div>
            @endif
        </div>
        
        <!-- Recently Purchased - Only show if there are completed items -->
        @if(count($completedItems) > 0)
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Recently Purchased</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($completedItems as $item)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-medium text-gray-900">{{ $item->name }}</h4>
                                <p class="text-sm text-gray-500">
                                    Purchased on {{ $item->purchased_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Add Wish Modal -->
<div id="addWishModal" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('addWishModal')"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-rose-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Add to Wishlist
                        </h3>
                        <div class="mt-4">
                            <form id="wishlistForm" action="{{ route('wishlist.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="modal-name" class="block text-sm font-medium text-gray-700">Item Name</label>
                                    <input type="text" name="name" id="modal-name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-rose-500 focus:border-rose-500 sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="modal-description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                                    <textarea name="description" id="modal-description" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-rose-500 focus:border-rose-500 sm:text-sm"></textarea>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="modal-price" class="block text-sm font-medium text-gray-700">Price (DH)</label>
                                        <input type="number" name="price" id="modal-price" min="0" step="0.01" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-rose-500 focus:border-rose-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="modal-monthly" class="block text-sm font-medium text-gray-700">Monthly Contribution (DH)</label>
                                        <input type="number" name="monthly_contribution" id="modal-monthly" min="0" step="0.01" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-rose-500 focus:border-rose-500 sm:text-sm">
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="modal-image" class="block text-sm font-medium text-gray-700">Image URL (Optional)</label>
                                    <input type="url" name="image_url" id="modal-image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-rose-500 focus:border-rose-500 sm:text-sm">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="document.getElementById('wishlistForm').submit()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-rose-600 text-base font-medium text-white hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Add to Wishlist
                </button>
                <button type="button" onclick="closeModal('addWishModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Contribute Modal -->
<div id="contributeModal" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('contributeModal')"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="contribute-title">
                            Add Funds
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Add an extra contribution to your savings for this item.
                            </p>
                        </div>
                        <div class="mt-4">
                            <form id="contributeForm" action="{{ route('wishlist.contribute') }}" method="POST">
                                @csrf
                                <input type="hidden" name="wishlist_id" id="contribute-id">
                                <div>
                                    <label for="contribute-amount" class="block text-sm font-medium text-gray-700">Amount (DH)</label>
                                    <input type="number" name="amount" id="contribute-amount" min="0" step="0.01" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="document.getElementById('contributeForm').submit()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Add Funds
                </button>
                <button type="button" onclick="closeModal('contributeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openAddWishModal() {
    document.getElementById('addWishModal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function openContributeModal(id) {
    document.getElementById('contribute-id').value = id;
    document.getElementById('contributeModal').classList.remove('hidden');
}

function confirmMarkComplete(id) {
    // Implement confirmation dialog or edit functionality
    if (confirm('Are you sure you want to mark this item as purchased?')) {
        // Submit form to mark as completed
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("wishlist.complete") }}';
        
        let csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        let wishlistId = document.createElement('input');
        wishlistId.type = 'hidden';
        wishlistId.name = 'wishlist_id';
        wishlistId.value = id;
        
        form.appendChild(csrfToken);
        form.appendChild(wishlistId);
        document.body.appendChild(form);
        form.submit();
    }
}

// Calculate estimated completion date based on input
document.addEventListener('DOMContentLoaded', function() {
    const priceInput = document.getElementById('modal-price');
    const monthlyInput = document.getElementById('modal-monthly');
    
    function updateEstimation() {
        const price = parseFloat(priceInput.value) || 0;
        const monthly = parseFloat(monthlyInput.value) || 0;
        
        if (price > 0 && monthly > 0) {
            const months = Math.ceil(price / monthly);
            const date = new Date();
            date.setMonth(date.getMonth() + months);
            
            // Display estimated date somewhere if needed
            console.log(`Estimated completion: ${date.toLocaleDateString()}`);
        }
    }
    
    priceInput.addEventListener('input', updateEstimation);
    monthlyInput.addEventListener('input', updateEstimation);
});
</script>
@endsection