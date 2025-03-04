@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white shadow-xl rounded-2xl border border-gray-100">
        <div class="bg-neutral-900 text-white p-6 rounded-t-2xl">
            <h1 class="text-3xl font-bold tracking-tight">Update Expense</h1>
        </div>
        
        <form method="POST" action="{{ route('expenses.update', $expense->id) }}" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Expense Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ $expense->name }}"
                    required 
                    placeholder="Enter expense name" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-neutral-500 transition duration-200"
                >
            </div>

            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <input 
                    type="text" 
                    name="description" 
                    id="description" 
                    value="{{ $expense->description }}"
                    required 
                    placeholder="Add a brief description" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-neutral-500 transition duration-200"
                >
            </div>

            <div class="space-y-2">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                    <input 
                        type="number" 
                        name="amount" 
                        id="amount" 
                        value="{{ $expense->amount }}"
                        required 
                        step="0.01" 
                        min="0" 
                        placeholder="0.00" 
                        class="w-full px-4 py-3 pl-7 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-neutral-500 transition duration-200"
                    >
                </div>
            </div>

            <div class="space-y-2">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select 
                    name="category_id" 
                    id="category_id" 
                    required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-neutral-500 transition duration-200"
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
            </div>

            <div class="space-y-2">
                <label for="is_fixed" class="block text-sm font-medium text-gray-700">Recurring Expense?</label>
                <select 
                    name="is_fixed" 
                    id="is_fixed" 
                    required 
                    onchange="toggleNextDateInput()" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-neutral-500 transition duration-200"
                >
                    <option value="yes" {{ $expense->is_fixed == 'yes' ? 'selected' : '' }}>Yes</option>
                    <option value="no" {{ $expense->is_fixed == 'no' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div 
                id="next_date_container" 
                class="space-y-2 {{ $expense->is_fixed == 'yes' ? '' : 'hidden' }}"
            >
                <label for="next_date" class="block text-sm font-medium text-gray-700">Next Recurring Date</label>
                <input 
                    type="date" 
                    name="next_date" 
                    id="next_date" 
                    value="{{ $expense->next_date }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-neutral-500 transition duration-200"
                >
            </div>

            <div class="pt-4">
                <button 
                    type="submit" 
                    class="w-full bg-neutral-900 text-white font-semibold py-3 rounded-lg hover:bg-neutral-800 transition duration-200 ease-in-out shadow-md"
                >
                    Update Expense
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleNextDateInput() {
        const isFixedSelect = document.getElementById('is_fixed');
        const nextDateContainer = document.getElementById('next_date_container');
        if (isFixedSelect.value === 'yes') {
            nextDateContainer.classList.remove('hidden');
        } else {
            nextDateContainer.classList.add('hidden');
        }
    }
</script>
@endsection