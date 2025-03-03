@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyMind Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f8fa;
        }
        
        .progress-bar {
            height: 0.5rem;
            border-radius: 0.25rem;
            background-color: #e5e7eb;
            overflow: hidden;
        }
        
        .progress-bar-fill {
            height: 100%;
            border-radius: 0.25rem;
            transition: width 0.5s ease;
        }
        
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        .suggestion-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .budget-card {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        }
        
        .expense-card {
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
        }
        
        .income-bar {
            background: linear-gradient(90deg, #84fab0 0%, #8fd3f4 100%);
        }
        
        .expense-bar {
            background: linear-gradient(90deg, #ff9a9e 0%, #fad0c4 100%);
        }
        
        .category-item:hover {
            background-color: #f3f4f6;
        }
        
        .wishlist-progress-fill {
            background: linear-gradient(90deg, #a78bfa 0%, #818cf8 100%);
        }
        
        .goal-progress-fill {
            background: linear-gradient(90deg, #34d399 0%, #10b981 100%);
        }
        
        .light-card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .nav-item {
            transition: all 0.3s ease;
        }
        
        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .active-nav {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid white;
        }
        
        .bg-indigo-600 {
            background-color: #FFDE5A;
            color: #13314E;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease;
        }
        
        .bg-indigo-600:hover {
            background-color: #FFD54F;
        }
        
        .text-gray-800 {
            font-weight: 600;
        }
        
        .text-sm {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- Main Layout -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col fixed h-full">
            <div class="p-4 flex items-center space-x-3 border-b">
                <h1 class="text-xl font-bold text-gray-800">MoneyMind</h1>
            </div>
            
            <div class="mt-8 flex-1 flex flex-col">
                <a href="#" class="nav-item flex items-center space-x-3 px-6 py-3 hover:bg-gray-100 transition duration-200">
                    <i class="fas fa-tachometer-alt text-gray-600"></i>
                    <span class="text-gray-800">Dashboard</span>
                </a>
                <a href="#" class="nav-item flex items-center space-x-3 px-6 py-3 hover:bg-gray-100 transition duration-200">
                    <i class="fas fa-money-bill-wave text-gray-600"></i>
                    <span class="text-gray-800">Expenses</span>
                </a>
                <a href="#" class="nav-item flex items-center space-x-3 px-6 py-3 hover:bg-gray-100 transition duration-200">
                    <i class="fas fa-calendar-alt text-gray-600"></i>
                    <span class="text-gray-800">Recurring</span>
                </a>
                <a href="#" class="nav-item flex items-center space-x-3 px-6 py-3 hover:bg-gray-100 transition duration-200">
                    <i class="fas fa-bullseye text-gray-600"></i>
                    <span class="text-gray-800">Goals</span>
                </a>
                <a href="#" class="nav-item flex items-center space-x-3 px-6 py-3 hover:bg-gray-100 transition duration-200">
                    <i class="fas fa-star text-gray-600"></i>
                    <span class="text-gray-800">Wishlist</span>
                </a>
                <a href="#" class="nav-item flex items-center space-x-3 px-6 py-3 hover:bg-gray-100 transition duration-200">
                    <i class="fas fa-cog text-gray-600"></i>
                    <span class="text-gray-800">Settings</span>
                </a>
            </div>
            
            <div class="p-4 mt-auto border-t">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="font-semibold text-gray-800">SM</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Sarah Morin</h3>
                        <p class="text-xs text-gray-500">Premium User</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="ml-64 flex-1">
            <!-- Top Nav -->
            <div class="bg-white py-3 px-6 flex justify-between items-center shadow-sm sticky top-0 z-10">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Dashboard Overview</h2>
                    <p class="text-sm text-gray-500">Welcome back, Sarah!</p>
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
            

            
            <!-- Dashboard Content -->
            <div class="p-6 bg-gray-50">
                <!-- Budget Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="card rounded-xl overflow-hidden">
                        <div class="budget-card p-6 text-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-white text-opacity-80">Remaining Budget</p>
                                    <h3 class="text-3xl font-bold mt-1">{{ Auth::user()->monthly_salary - $expenses->sum('amount') }} DH</h3>
                                </div>
                                <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                                    <i class="fas fa-wallet text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="w-full h-2 bg-white bg-opacity-20 rounded-full overflow-hidden">
                                    <div class="h-full bg-white rounded-full" style="width: 65%;"></div>
                                </div>
                                <p class="text-sm mt-2 text-white text-opacity-80">65% of budget remaining</p>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Monthly Budget: {{ Auth::user()->monthly_salary }} DH</span>
                                <span>Next Reset: {{ Auth::user()->salary_credit_date }} Mar</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card rounded-xl overflow-hidden">
                        <div class="expense-card p-6 text-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-white text-opacity-80">Total Spent</p>
                                    <h3 class="text-3xl font-bold mt-1">{{ $expenses->sum('amount')   }} DH</h3>
                                </div>
                                <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                                    <i class="fas fa-money-bill-wave text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="w-full h-2 bg-white bg-opacity-20 rounded-full overflow-hidden">
                                    <div class="h-full bg-white rounded-full" style="width: 35%;"></div>
                                </div>
                                <p class="text-sm mt-2 text-white text-opacity-80">35% of budget spent</p>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>This Month: +12%</span>
                                <span>Last Update: Today</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card rounded-xl overflow-hidden">
                        <div class="suggestion-card p-6 text-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-white text-opacity-80">AI Suggestion</p>
                                    <h3 class="text-xl font-medium mt-2 leading-tight">Consider reducing your divertissement expenses to reach your vacation goal faster.</h3>
                                </div>
                                <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                                    <i class="fas fa-robot text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Based on your spending habits</span>
                                <span class="text-indigo-600 font-medium cursor-pointer">More Tips</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Main Dashboard Sections -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column - Expense Categories -->
                    <!-- <div class="lg:col-span-2">
                        <div class="light-card p-6 mb-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-800">Expense Breakdown</h3>
                                <div class="flex items-center space-x-2">
                                    <select class="text-sm px-3 py-1.5 bg-gray-100 rounded-md border-0 focus:ring-2 focus:ring-indigo-500">
                                        <option>February 2025</option>
                                        <option>January 2025</option>
                                        <option>December 2024</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="h-64 relative">
                                        <canvas id="categoryChart"></canvas>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="category-item flex items-center p-3 rounded-lg hover:cursor-pointer">
                                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-4"></div>
                                        <div class="flex-1">
                                            <div class="flex justify-between mb-1">
                                                <h4 class="font-medium">Divertissement</h4>
                                                <span class="font-semibold">600 DH</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress-bar-fill" style="width: 35%; background-color: #3b82f6;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="category-item flex items-center p-3 rounded-lg hover:cursor-pointer">
                                        <div class="w-3 h-3 rounded-full bg-red-500 mr-4"></div>
                                        <div class="flex-1">
                                            <div class="flex justify-between mb-1">
                                                <h4 class="font-medium">Factures</h4>
                                                <span class="font-semibold">510 DH</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress-bar-fill" style="width: 30%; background-color: #ef4444;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="category-item flex items-center p-3 rounded-lg hover:cursor-pointer">
                                        <div class="w-3 h-3 rounded-full bg-green-500 mr-4"></div>
                                        <div class="flex-1">
                                            <div class="flex justify-between mb-1">
                                                <h4 class="font-medium">Nourriture</h4>
                                                <span class="font-semibold">425 DH</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress-bar-fill" style="width: 25%; background-color: #10b981;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="category-item flex items-center p-3 rounded-lg hover:cursor-pointer">
                                        <div class="w-3 h-3 rounded-full bg-yellow-500 mr-4"></div>
                                        <div class="flex-1">
                                            <div class="flex justify-between mb-1">
                                                <h4 class="font-medium">Transport</h4>
                                                <span class="font-semibold">215 DH</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress-bar-fill" style="width: 10%; background-color: #f59e0b;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 text-center">
                                <button class="text-indigo-600 font-medium hover:underline">View All Categories</button>
                            </div>
                        </div> -->
                        
                        <!-- Recent Transactions -->
                        <div class="light-card p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-800">Recent Transactions</h3>
                                <button class="text-indigo-600 font-medium hover:underline">View All</button>
                            </div>
                            
                            <div class="space-y-4">
                                @foreach($expenses as $expense)
                                <div class="flex items-center p-3 bg-white border border-gray-100 rounded-lg">
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <div>
                                                <h4 class="font-medium">{{ $expense->name }}</h4>
                                                <p class="text-sm text-gray-500">{{ $expense->description }}</p>
                                            </div>
                                            <div class="text-right">
                                                <span class="font-semibold text-red-500">-{{ $expense->amount }} DH</span>
                                                <p class="text-xs text-gray-500">{{ $expense->date }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Goals & Wishlist -->
                    <div class="space-y-6">
                        <!-- Savings Goals -->
                        <!-- <div class="light-card p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-800">Savings Goals</h3>
                                <button class="p-2 text-gray-500 hover:text-indigo-600">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                            <div class="space-y-6">
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <div>
                                            <h4 class="font-medium">Emergency Fund</h4>
                                            <p class="text-sm text-gray-500">200 DH saved of 1,000 DH</p>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">20%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="goal-progress-fill" style="width: 20%;"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <div>
                                            <h4 class="font-medium">Vacation</h4>
                                            <p class="text-sm text-gray-500">500 DH saved of 2,000 DH</p>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">25%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="goal-progress-fill" style="width: 25%;"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <div>
                                            <h4 class="font-medium">Education</h4>
                                            <p class="text-sm text-gray-500">300 DH saved of 3,000 DH</p>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">10%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="goal-progress-fill" style="width: 10%;"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 text-center">
                                <button class="text-indigo-600 font-medium hover:underline">Manage Goals</button>
                            </div>
                        </div>
                         -->
                        <!-- Wishlist -->
                        <!-- <div class="light-card p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-800">Wishlist</h3>
                                <button class="p-2 text-gray-500 hover:text-indigo-600">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                            <div class="space-y-6">
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <div>
                                            <h4 class="font-medium">Casque Audio</h4>
                                            <p class="text-sm text-gray-500">100 DH saved of 1,000 DH</p>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">10%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="wishlist-progress-fill" style="width: 10%;"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <div>
                                            <h4 class="font-medium">New Laptop</h4>
                                            <p class="text-sm text-gray-500">2,000 DH saved of 10,000 DH</p>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">20%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="wishlist-progress-fill" style="width: 20%;"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <div>
                                            <h4 class="font-medium">Smart Watch</h4>
                                            <p class="text-sm text-gray-500">450 DH saved of 1,500 DH</p>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">30%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="wishlist-progress-fill" style="width: 30%;"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 text-center">
                                <button class="text-indigo-600 font-medium hover:underline">View All Items</button>
                            </div>
                        </div> -->
                        
                        <!-- Budget Timeline -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Configure Category Chart
        const categoryChart = new Chart(
            document.getElementById('categoryChart'),
            {
                type: 'doughnut',
                data: {
                    labels: ['Divertissement', 'Factures', 'Nourriture', 'Transport'],
                    datasets: [{
                        data: [600, 510, 425, 215],
                        backgroundColor: [
                            '#3b82f6',
                            '#ef4444',
                            '#10b981',
                            '#f59e0b'
                        ],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw} DH (${Math.round((context.raw / 1750) * 100)}%)`;
                                }
                            }
                        }
                    }
                }
            }
        );
        
        // Configure Timeline Chart
        const timelineChart = new Chart(
            document.getElementById('timelineChart'),
            {
                type: 'line',
                data: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [{
                        label: 'Spending',
                        data: [400, 950, 1400, 1750],
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Budget Line',
                        data: [1250, 2500, 3750, 5000],
                        borderColor: '#3b82f6',
                        borderDash: [5, 5],
                        fill: false,
                        tension: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + ' DH';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            }
        );
    </script>
</body>
</html>