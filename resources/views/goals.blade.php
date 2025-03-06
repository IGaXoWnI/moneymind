@php
    use Illuminate\Support\Facades\Auth as AuthFacade;
@endphp
@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-purple-50 to-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Beautiful Title Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center">
                <div class="relative">
                    <div class="relative px-7 py-4 leading-none flex items-center">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-indigo-600 to-purple-700 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <span class="font-extrabold text-4xl ml-4 text-gray-900">
                            Savings <span class="text-indigo-600">Goals</span>
                        </span>
                    </div>
                </div>
            </div>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-600">
                Turn your dreams into reality, one saving at a time
            </p>
        </div>

        <!-- Current Goal Card -->
        @if($savingGoal)
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-10 transform transition-all duration-300 hover:shadow-2xl">
            <div class="px-6 py-8 sm:p-10">
                <!-- Header with Status -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-2xl font-bold text-gray-900">Monthly Savings Plan</h3>
                            <p class="text-gray-500 mt-1">Automatically saving for your future</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="mr-1.5 h-2 w-2 text-green-600" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Active
                    </span>
                </div>

                <!-- Monthly Contribution Card -->
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 mb-8 border border-indigo-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-sm font-medium text-indigo-800 uppercase tracking-wide">Monthly Contribution</h4>
                            <div class="mt-1 flex items-baseline">
                                <span class="text-3xl font-extrabold text-indigo-900">
                                    {{ number_format($savingGoal->monthly_contribution, 2) }} DH
                                </span>
                                <span class="ml-2 text-sm text-indigo-700">every month</span>
                            </div>
                        </div>
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-indigo-700">
                        <p>Next automatic saving on <span class="font-medium">{{ now()->addMonth()->setDay(AuthFacade::user()->salary_credit_date - 1)->format('F j, Y') }}</span></p>
                    </div>
                </div>

                <!-- Total Amount Saved Card -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide">Total Amount Saved</h4>
                    <div class="mt-2 flex items-baseline">
                        <span class="text-3xl font-extrabold text-gray-900">
                            {{ number_format($savingGoal->current_amount, 2) }} DH
                        </span>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-gray-500">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>You're building a great financial foundation</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-4">
                    <button type="button" onclick="openEditModal()" class="flex-1 inline-flex justify-center items-center px-4 py-3 border border-gray-300 bg-white rounded-lg shadow-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm transition duration-200">
                        Modify Monthly Amount
                    </button>
                    <button type="button" onclick="openContributeModal()" class="flex-1 inline-flex justify-center items-center px-4 py-3 border border-transparent bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-sm font-medium text-white hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm transition duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Extra Contribution
                    </button>
                </div>
            </div>
        </div>
        @else
        <!-- No Goal Yet - Elegant Empty State -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-10 text-center py-16 px-6 max-w-lg mx-auto">
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 bg-gradient-to-b from-indigo-50 to-purple-50 rounded-full flex items-center justify-center mb-6 border-4 border-white shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Start Your Savings Journey</h3>
                <p class="text-gray-600 mb-8 max-w-sm mx-auto">
                    Set up automatic monthly savings to build your financial security. 
                    We'll handle the transfers on your behalf.
                </p>
                <button type="button" onclick="openCreateModal()" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-md text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 transform hover:-translate-y-0.5">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Set Up Monthly Savings
                </button>
            </div>
        </div>
        @endif

        <!-- Create Goal Modal with Beautiful Design -->
        <div id="createModal" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeModal('createModal')"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button type="button" onclick="closeModal('createModal')" class="bg-white rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Modal header with icon -->
                    <div>
                        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="text-xl font-bold text-gray-900" id="modal-title">
                                Set Up Monthly Savings
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">
                                    Choose an amount to automatically save each month. We'll transfer it from your budget one day before your salary date.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('saving-goals.store') }}" method="POST" class="mt-6 space-y-5">
                        @csrf
                        <div>
                            <label for="monthly_contribution" class="block text-sm font-medium text-gray-700 mb-1">Monthly Contribution (DH)</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">DH</span>
                                </div>
                                <input type="number" name="monthly_contribution" id="monthly_contribution" min="0" step="0.01" 
                                       class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                       placeholder="0.00" required>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Set an amount you can comfortably save each month</p>
                        </div>

                        <!-- Information alert box -->
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Automatic transfers will happen on day {{ AuthFacade::user()->salary_credit_date - 1 }} of each month, one day before your salary date.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 mt-6 pt-5 border-t border-gray-100">
                            <button type="button" onclick="closeModal('createModal')" class="inline-flex justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit" class="inline-flex justify-center px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg shadow-sm hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Set Up Savings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modify Monthly Amount Modal -->
        <div id="editModal" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeModal('editModal')"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button type="button" onclick="closeModal('editModal')" class="bg-white rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <h3 class="text-lg font-medium text-gray-900" id="modal-title">Modify Monthly Amount</h3>
                    @if(isset($savingGoal))
                        <form id="editForm" action="{{ route('saving-goals.update', $savingGoal->id) }}" method="POST" class="mt-6 space-y-5">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="monthly_contribution" class="block text-sm font-medium text-gray-700 mb-1">Monthly Contribution (DH)</label>
                                <input type="number" name="monthly_contribution" id="monthly_contribution" min="0" step="0.01" class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., 1000" value="{{ $savingGoal->monthly_contribution }}" required>
                            </div>
                        </form>
                    @else
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">No saving goal found. Please create a new one.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Add Extra Contribution Modal -->
        <div id="extraContributionModal" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeModal('extraContributionModal')"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button type="button" onclick="closeModal('extraContributionModal')" class="bg-white rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <h3 class="text-lg font-medium text-gray-900" id="modal-title">Add Extra Contribution</h3>
                    @if(isset($savingGoal))
                        <form id="extraContributionForm" action="{{ route('saving-goals.add-extra-contribution', $savingGoal->id) }}" method="POST" class="mt-6 space-y-5">
                            @csrf
                            <div>
                                <label for="extra_contribution" class="block text-sm font-medium text-gray-700 mb-1">Extra Contribution Amount (DH)</label>
                                <input type="number" name="extra_contribution" id="extra_contribution" min="0" step="0.01" class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., 500" required>
                            </div>

                            <div class="flex justify-end gap-3 mt-5">
                                <button type="button" onclick="closeModal('extraContributionModal')" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </button>
                                <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 border border-transparent rounded-md shadow-sm hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add Contribution
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">No saving goal found. Please create a new one.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function openEditModal() {
    document.getElementById('editModal').classList.remove('hidden');
}

function openContributeModal() {
    document.getElementById('extraContributionModal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}
</script>
@endsection