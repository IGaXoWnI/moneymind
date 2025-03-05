@php
    use Illuminate\Support\Facades\Auth as AuthFacade;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyMind Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
        }
        
        .top-gradient {
            background: linear-gradient(90deg, #13314E, #235789);
        }
        
        .progress-bar {
            height: 6px;
            border-radius: 6px;
            background-color: rgba(229, 231, 235, 0.5);
            overflow: hidden;
        }
        
        .progress-bar-fill {
            height: 100%;
            border-radius: 6px;
            transition: width 0.5s ease;
        }
        
        .card {
            border-radius: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            background: white;
        }
        
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .budget-card {
            background: linear-gradient(135deg, #13314E 0%, #235789 100%);
            color: white;
        }
        
        .expense-card {
            background: linear-gradient(135deg, #EF4444 0%, #F87171 100%);
            color: white;
        }
        
        .suggestion-card {
            background: linear-gradient(135deg, #FFDE5A 0%, #FFD54F 100%);
            color: #13314E;
        }
        
        .nav-item {
            position: relative;
            transition: all 0.2s ease;
            border-radius: 8px;
        }
        
        .nav-item:hover, .nav-item.active {
            background-color: rgba(19, 49, 78, 0.05);
            color: #13314E;
        }
        
        .nav-item.active {
            font-weight: 600;
        }
        
        .nav-item.active:before {
            content: "";
            position: absolute;
            left: -16px;
            top: 50%;
            transform: translateY(-50%);
            height: 60%;
            width: 3px;
            background-color: #13314E;
            border-radius: 0 3px 3px 0;
        }
        
        .btn-primary {
            background-color: #13314E;
            color: white;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background-color: #0c253d;
        }
        
        .btn-secondary {
            background-color: #FFDE5A;
            color: #13314E;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .btn-secondary:hover {
            background-color: #ffd321;
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        
        .glassmorphism {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .transaction-item {
            border-radius: 12px;
            transition: background-color 0.2s ease;
        }
        
        .transaction-item:hover {
            background-color: rgba(243, 244, 246, 0.8);
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <!-- Mobile sidebar backdrop -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>
        
        <!-- Sidebar -->
        <x-sidebar />
        
        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Nav -->
            <div class="sticky top-0 z-10 glassmorphism">
                <div class="top-gradient h-1.5"></div>
                <div class="px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="mr-4 text-gray-600 lg:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div>
                            <h1 class="text-xl font-bold text-gray-800">Dashboard</h1>
                            <p class="text-sm text-gray-500">Welcome back, {{ AuthFacade::user()->name ?? 'User' }}!</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('expenses.create') }}" class="btn-secondary px-4 py-2 text-sm font-medium flex items-center">
                            <i class="fas fa-plus mr-2"></i> Add Expense
                        </a>
                        <div class="relative">
                            <button class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Budget Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="card overflow-hidden">
                        <div class="budget-card p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <p class="text-opacity-90 text-sm">Remaining Budget</p>
                                    <h3 class="text-3xl font-bold mt-1">{{ (AuthFacade::user()->budget )}} DH</h3>
                                </div>
                                <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                                    <i class="fas fa-wallet text-xl"></i>
                                </div>
                            </div>
                            
                            <div>
                                <div class="w-full h-2 bg-white bg-opacity-20 rounded-full overflow-hidden">
                                    @php
                                        $budgetPercent = AuthFacade::user()->monthly_salary > 0 
                                            ? 100 - (($expenses->sum('amount') / AuthFacade::user()->monthly_salary) * 100)
                                            : 0;
                                        $budgetPercent = max(0, min(100, $budgetPercent));
                                    @endphp
                                    <div class="h-full bg-white rounded-full" style="width: {{ $budgetPercent }}%;"></div>
                                </div>
                                <div class="flex justify-between mt-2 text-sm">
                                    <p>{{ number_format($budgetPercent, 0) }}% remaining</p>
                                    <p>{{ number_format(AuthFacade::user()->monthly_salary, 0) }} DH total</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 flex justify-between text-sm text-gray-500">
                            <span>Monthly Budget</span>
                            <span>Resets: {{ AuthFacade::user()->salary_credit_date ?? '1st' }} of month</span>
                        </div>
                    </div>
                    
                    <div class="card overflow-hidden">
                        <div class="expense-card p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <p class="text-opacity-90 text-sm">Total Spent</p>
                                    <h3 class="text-3xl font-bold mt-1">{{ number_format($expenses->sum('amount'), 0) }} DH</h3>
                                </div>
                                <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                                    <i class="fas fa-receipt text-xl"></i>
                                </div>
                            </div>
                            
                            <div>
                                <div class="w-full h-2 bg-white bg-opacity-20 rounded-full overflow-hidden">
                                    @php
                                        $spentPercent = AuthFacade::user()->monthly_salary > 0 
                                            ? ($expenses->sum('amount') / AuthFacade::user()->monthly_salary) * 100
                                            : 0;
                                        $spentPercent = max(0, min(100, $spentPercent));
                                    @endphp
                                    <div class="h-full bg-white rounded-full" style="width: {{ $spentPercent }}%;"></div>
                                </div>
                                <div class="flex justify-between mt-2 text-sm">
                                    <p>{{ number_format($spentPercent, 0) }}% of budget</p>
                                    <p>{{ $expenses->count() }} transactions</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 flex justify-between text-sm text-gray-500">
                            <span>This Month</span>
                            <span>Last update: Today</span>
                        </div>
                    </div>
                    
                    <div class="card overflow-hidden">
                        <div class="suggestion-card p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <p class="text-opacity-90 text-sm">AI Suggestion</p>
                                    <h3 class="text-xl font-semibold mt-1 leading-tight">Consider reducing your entertainment expenses to reach your vacation goal faster.</h3>
                                </div>
                                <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                                    <i class="fas fa-lightbulb text-xl"></i>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <button class="bg-white bg-opacity-30 text-xs px-3 py-1 rounded-full font-medium">
                                    Show me how
                                </button>
                            </div>
                        </div>
                        <div class="p-4 flex justify-between text-sm">
                            <span class="text-gray-500">Based on your spending patterns</span>
                            <span class="text-[#13314E] font-medium cursor-pointer">View more tips</span>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content Section -->
                <div class="card p-6 mb-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">Recent Transactions</h3>
        <div class="flex items-center space-x-2">
            <div class="relative">
                <select class="pl-3 pr-8 py-2 text-sm bg-gray-50 rounded-lg border-0 focus:ring-2 focus:ring-[#13314E] appearance-none">
                    <option>All Categories</option>
                    <option>Food & Dining</option>
                    <option>Transportation</option>
                    <option>Entertainment</option>
                    <option>Bills & Utilities</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                </div>
            </div>
            <button class="btn-primary px-4 py-2 text-sm">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </div>
    </div>
    
    <div class="space-y-3">
        @forelse($expenses as $expense)
        <div class="transaction-item p-4 border border-gray-100 flex items-center justify-between">
            <div class="flex items-center">
                <div class="h-10 w-10 rounded-full flex items-center justify-center mr-4
                    @if(strpos(strtolower($expense->name), 'food') !== false || strpos(strtolower($expense->description), 'food') !== false)
                        bg-green-100 text-green-600
                    @elseif(strpos(strtolower($expense->name), 'bill') !== false || strpos(strtolower($expense->description), 'bill') !== false)
                        bg-blue-100 text-blue-600
                    @elseif(strpos(strtolower($expense->name), 'transport') !== false || strpos(strtolower($expense->description), 'transport') !== false)
                        bg-yellow-100 text-yellow-600
                    @elseif(strpos(strtolower($expense->name), 'entertainment') !== false || strpos(strtolower($expense->description), 'entertainment') !== false)
                        bg-purple-100 text-purple-600
                    @else
                        bg-gray-100 text-gray-600
                    @endif
                ">
                    <i class="
                    @if(strpos(strtolower($expense->name), 'food') !== false || strpos(strtolower($expense->description), 'food') !== false)
                        fas fa-utensils
                    @elseif(strpos(strtolower($expense->name), 'bill') !== false || strpos(strtolower($expense->description), 'bill') !== false)
                        fas fa-file-invoice
                    @elseif(strpos(strtolower($expense->name), 'transport') !== false || strpos(strtolower($expense->description), 'transport') !== false)
                        fas fa-car
                    @elseif(strpos(strtolower($expense->name), 'entertainment') !== false || strpos(strtolower($expense->description), 'entertainment') !== false)
                        fas fa-film
                    @else
                        fas fa-shopping-bag
                    @endif
                    "></i>
                </div>
                <div>
                    <h4 class="font-medium text-gray-800">{{ $expense->name }}</h4>
                    <p class="text-sm text-gray-500">{{ $expense->description }}</p>
                </div>
            </div>
            
            <div class="flex items-center">
                <div class="text-right mr-4">
                    <span class="font-semibold text-red-500 block">- {{ number_format($expense->amount, 0) }} DH</span>
                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</p>
                </div>
                
                <div class="flex space-x-2">
                    <a href="{{ route('expenses.edit', $expense->id) }}" class="h-8 w-8 bg-gray-50 hover:bg-gray-100 rounded-lg flex items-center justify-center transition-colors duration-150" title="Edit">
                        <i class="fas fa-pencil-alt text-[#13314E] text-sm"></i>
                    </a>
                    
                    <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this expense?')" class="h-8 w-8 bg-gray-50 hover:bg-red-50 rounded-lg flex items-center justify-center transition-colors duration-150" title="Delete">
                            <i class="fas fa-trash-alt text-red-500 text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                <i class="fas fa-receipt text-gray-400 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-800 mb-1">No transactions yet</h3>
            <p class="text-gray-500 mb-4">Start tracking your expenses to see them here</p>
            <a href="{{ route('expenses.create') }}" class="btn-primary px-5 py-2 inline-block">Add Your First Expense</a>
        </div>
        @endforelse
    </div>
    
    @if($expenses->count() > 0)
    <div class="mt-6 text-center">
        <button class="btn-primary px-6 py-2.5">View All Transactions</button>
    </div>
    @endif
</div>
                
                <!-- Additional Features Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="card p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-5">Weekly Spending Overview</h3>
                        <div class="h-64">
                            <canvas id="weeklySpendingChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="card p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-5">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="#" class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex flex-col items-center text-center">
                                    <div class="h-12 w-12 rounded-full bg-[#13314E] text-white flex items-center justify-center mb-3">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <h4 class="font-medium text-gray-800">Add Expense</h4>
                                    <p class="text-xs text-gray-500 mt-1">Track new spending</p>
                                </div>
                            </a>
                            
                            <a href="#" class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex flex-col items-center text-center">
                                    <div class="h-12 w-12 rounded-full bg-[#FFDE5A] text-[#13314E] flex items-center justify-center mb-3">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <h4 class="font-medium text-gray-800">Analytics</h4>
                                    <p class="text-xs text-gray-500 mt-1">View detailed reports</p>
                                </div>
                            </a>
                            
                            <a href="#" class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex flex-col items-center text-center">
                                    <div class="h-12 w-12 rounded-full bg-green-500 text-white flex items-center justify-center mb-3">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                    <h4 class="font-medium text-gray-800">Set Goal</h4>
                                    <p class="text-xs text-gray-500 mt-1">Plan your savings</p>
                                </div>
                            </a>
                            
                            <a href="#" class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex flex-col items-center text-center">
                                    <div class="h-12 w-12 rounded-full bg-purple-500 text-white flex items-center justify-center mb-3">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <h4 class="font-medium text-gray-800">Recurring</h4>
                                    <p class="text-xs text-gray-500 mt-1">Manage subscriptions</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="mt-8 py-6 border-t border-gray-100">
                <div class="container mx-auto px-6">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-sm text-gray-500 mb-4 md:mb-0">
                            © 2025 MoneyMind. All rights reserved.
                        </div>
                        <div class="flex space-x-4">
                            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Privacy Policy</a>
                            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Terms of Service</a>
                            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Contact Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Weekly Spending Chart
        const weeklySpendingCtx = document.getElementById('weeklySpendingChart').getContext('2d');
        const weeklySpendingChart = new Chart(weeklySpendingCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Daily Spending',
                    data: [150, 220, 180, 310, 280, 420, 190],
                    backgroundColor: [
                        'rgba(19, 49, 78, 0.7)',
                        'rgba(19, 49, 78, 0.7)',
                        'rgba(19, 49, 78, 0.7)',
                        'rgba(19, 49, 78, 0.7)',
                        'rgba(19, 49, 78, 0.7)',
                        'rgba(255, 222, 90, 0.8)',
                        'rgba(19, 49, 78, 0.7)'
                    ],
                    borderColor: [
                        'rgba(19, 49, 78, 1)',
                        'rgba(19, 49, 78, 1)',
                        'rgba(19, 49, 78, 1)',
                        'rgba(19, 49, 78, 1)',
                        'rgba(19, 49, 78, 1)',
                        'rgba(255, 222, 90, 1)',
                        'rgba(19, 49, 78, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.raw} DH`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + ' DH';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
                