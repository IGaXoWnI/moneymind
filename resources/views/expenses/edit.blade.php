@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10 bg-gray-50">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Update Expense</h1>
            <p class="mt-2 text-lg text-gray-600">Edit your expense details</p>
        </div>
        
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border-0 transform transition-all hover:scale-[1.01] duration-300">
            <!-- Form Header with Gradient -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 p-8 relative">
                <div class="absolute top-0 right-0 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white">Modify Expense</h2>
                <p class="text-teal-100 mt-1">Update the information for this expense</p>
            </div>
            
            <form method="POST" action="{{ route('expenses.update', $expense->id) }}" class="p-8 space-y-7">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Expense Name -->
                    <div class="space-y-2 col-span-2">
                        <label for="name" class="text-sm font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Expense Name
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ $expense->name }}"
                            required 
                            placeholder="What did you spend on?" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200 bg-gray-50"
                        >
                    </div>

                    <!-- Description -->
                    <div class="space-y-2 col-span-2">
                        <label for="description" class="text-sm font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Description
                        </label>
                        <textarea
                            name="description" 
                            id="description"
                            required 
                            placeholder="Add additional details about this expense" 
                            rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200 bg-gray-50"
                        >{{ $expense->description }}</textarea>
                    </div>

                    <!-- Amount -->
                    <div class="space-y-2">
                        <label for="amount" class="text-sm font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Amount (DH)
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <span class="text-gray-500 font-medium">DH</span>
                            </div>
                            <input 
                                type="number" 
                                name="amount" 
                                id="amount" 
                                value="{{ $expense->amount }}"
                                required 
                                step="0.01" 
                                min="0" 
                                placeholder="0.00" 
                                class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200 bg-gray-50"
                            >
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="space-y-2">
                        <label for="category_id" class="text-sm font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Category
                        </label>
                        <div class="relative">
                            <select 
                                name="category_id" 
                                id="category_id" 
                                required 
                                class="w-full pl-4 pr-10 py-3 appearance-none border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200 bg-gray-50"
                            >
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option 
                                        value="{{ $category->id }}" 
                                        {{ $expense->category_id == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recurring Expense Section -->
                <div class="pt-4 border-t border-gray-100">
                    <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Recurring Details
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Is Fixed -->
                        <div class="space-y-2">
                            <label for="is_fixed" class="text-sm font-medium text-gray-700">Is this a recurring expense?</label>
                            <div class="relative">
                                <select 
                                    name="is_fixed" 
                                    id="is_fixed" 
                                    required 
                                    onchange="toggleNextDateInput()" 
                                    class="w-full pl-4 pr-10 py-3 appearance-none border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200 bg-gray-50"
                                >
                                    <option value="yes" {{ $expense->is_fixed == 'yes' ? 'selected' : '' }}>Yes - This happens regularly</option>
                                    <option value="no" {{ $expense->is_fixed == 'no' ? 'selected' : '' }}>No - One-time expense</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Next Date -->
                        <div id="next_date_container" class="space-y-2 {{ $expense->is_fixed == 'yes' ? '' : 'hidden' }}">
                            <label for="next_date" class="text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Day of month
                            </label>
                            <input 
                                type="number" 
                                name="next_date" 
                                id="next_date"
                                value="{{ $expense->next_date }}"
                                min="1"
                                max="31"
                                placeholder="Enter day (1-31)" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200 bg-gray-50"
                            >
                            <p class="text-xs text-gray-500 mt-1">On which day of each month does this expense occur?</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button and Cancel -->
                <div class="pt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('dashboard') }}" 
                       class="md:order-1 py-4 px-4 rounded-xl bg-gray-200 text-gray-800 font-medium text-center hover:bg-gray-300 transition duration-300 flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                    
                    <button 
                        type="submit" 
                        class="md:order-2 bg-gradient-to-r from-emerald-600 to-teal-700 text-white font-bold py-4 px-4 rounded-xl hover:from-emerald-700 hover:to-teal-800 transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg flex justify-center items-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Expense
                    </button>
                </div>
                
                <!-- Delete Button -->
                <div class="pt-6 border-t border-gray-200 mt-6">
                    <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this expense?');">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="w-full py-3 px-4 rounded-xl bg-red-50 text-red-600 font-medium text-center hover:bg-red-100 transition duration-300 flex justify-center items-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Expense
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleNextDateInput() {
        const isFixedSelect = document.getElementById('is_fixed');
        const nextDateContainer = document.getElementById('next_date_container');
        
        if (isFixedSelect.value === 'yes') {
            nextDateContainer.classList.remove('hidden');
            document.getElementById('next_date').setAttribute('required', 'required');
        } else {
            nextDateContainer.classList.add('hidden');
            document.getElementById('next_date').removeAttribute('required');
        }
    }
</script>
@endsection