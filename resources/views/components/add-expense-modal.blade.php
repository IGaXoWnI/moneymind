<div x-show="showModal" @click.away="showModal = false" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-75" style="display: none;">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-lg font-semibold mb-4">Add Expense</h2>
        <form method="POST" action="{{ route('expenses.store') }}">
            @csrf
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <input type="text" name="description" id="description" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" id="amount" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="flex justify-end">
                <button type="button" @click="showModal = false" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Add Expense</button>
            </div>
        </form>
    </div>
</div> 