@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-6">
    <h1 class="text-2xl font-bold mb-4">Add New Expense</h1>
    <form method="POST" action="{{ route('expenses.store') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <input type="text" name="description" id="description" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
            <input type="number" name="amount" id="amount" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id" id="category_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="is_fixed" class="block text-sm font-medium text-gray-700">Is this a fixed expense?</label>
            <select name="is_fixed" id="is_fixed" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" onchange="toggleNextDateInput()">
                <option value="">Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div id="next_date_container" class="mb-4 hidden">
            <label for="next_date" class="block text-sm font-medium text-gray-700">Next Date</label>
            <input type="date" name="next_date" id="next_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="date" id="date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Add Expense</button>
    </form>
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