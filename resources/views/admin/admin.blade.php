<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyMind Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #13314E 0%, #1E5283 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }
        .btn-primary {
            background: linear-gradient(135deg, #13314E 0%, #1E5283 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            box-shadow: 0 4px 12px rgba(19, 49, 78, 0.3);
        }
        .table-row {
            transition: all 0.2s ease;
        }
        .table-row:hover {
            background-color: #f9fafb;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Top Nav -->
        <div class="bg-gradient-primary text-white shadow-lg">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">MoneyMind Admin</h1>
                        <p class="text-sm opacity-80 mt-1">Manage your platform with confidence</p>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <div class="h-8 w-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 border border-white border-opacity-20">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-6 py-10 flex-grow">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div class="bg-white rounded-xl shadow-sm p-7 card-hover border border-gray-100">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-semibold text-gray-800">Total Users</h3>
                        <div class="bg-blue-100 text-blue-600 p-3.5 rounded-xl">
                            <i class="fas fa-users text-lg"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-800 mb-1">{{ $totalUsers }}</p>
                    <p class="text-sm text-gray-500 flex items-center">
                        <span class="text-emerald-500 mr-1"><i class="fas fa-arrow-up text-xs"></i> 12%</span>
                        Active user accounts
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-7 card-hover border border-gray-100">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-semibold text-gray-800">Total Categories</h3>
                        <div class="bg-emerald-100 text-emerald-600 p-3.5 rounded-xl">
                            <i class="fas fa-tags text-lg"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-800 mb-1">{{ $totalCategories }}</p>
                    <p class="text-sm text-gray-500 flex items-center">
                        <span class="text-emerald-500 mr-1"><i class="fas fa-check text-xs"></i></span>
                        Available expense categories
                    </p>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="bg-white rounded-xl shadow-sm p-7 mb-8 border border-gray-100">
                <div class="flex justify-between items-center mb-7">
                    <h3 class="text-xl font-semibold text-gray-800">Manage Categories</h3>
                    <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')" 
                            class="btn-primary text-white px-5 py-2.5 rounded-lg text-sm font-medium flex items-center">
                        <i class="fas fa-plus mr-2"></i> Add Category
                    </button>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-100">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-3.5 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3.5 text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3.5 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($categories as $category)
                            <tr class="table-row">
                                <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $category->description }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <button onclick="editCategory('{{ $category->id }}', '{{ $category->name }}', '{{ $category->description }}')" 
                                                class="text-blue-600 hover:text-blue-800 transition-colors p-1.5 rounded-md hover:bg-blue-50">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors p-1.5 rounded-md hover:bg-red-50" 
                                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Users Section -->
            <div class="bg-white rounded-xl shadow-sm p-7 border border-gray-100">
                <div class="flex justify-between items-center mb-7">
                    <h3 class="text-xl font-semibold text-gray-800">Manage Users</h3>
                    <div class="relative w-64">
                        <input type="text" placeholder="Search users..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto rounded-lg border border-gray-100">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-3.5 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3.5 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3.5 text-xs font-medium text-gray-500 uppercase tracking-wider">Joined Date</th>
                                <th class="px-6 py-3.5 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($users as $user)
                            <tr class="table-row">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3">
                                            <span class="font-medium text-sm">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                        <span class="font-medium">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <button class="text-indigo-600 hover:text-indigo-800 transition-colors p-1.5 rounded-md hover:bg-indigo-50">
                                            <i class="fas fa-user-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors p-1.5 rounded-md hover:bg-red-50"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-xl p-7 w-full max-w-md shadow-2xl transform transition-all">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-semibold text-gray-800">Add New Category</h3>
                <button onclick="document.getElementById('addCategoryModal').classList.add('hidden')" 
                        class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')"
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                            class="btn-primary px-5 py-2.5 text-sm font-medium text-white rounded-lg">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Edit Category</h3>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" id="editCategoryName" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="editCategoryDescription" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex justify-center space-x-3">
                    <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-black rounded-lg hover:bg-[#0f2a42]">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editCategory(id, name, description) {
            // Set form action URL
            const form = document.getElementById('editCategoryForm');
            form.action = `/admin/categories/${id}`;
            
            // Set form values
            document.getElementById('editCategoryName').value = name;
            document.getElementById('editCategoryDescription').value = description;
            
            // Show modal
            document.getElementById('editCategoryModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editCategoryModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const addModal = document.getElementById('addCategoryModal');
            const editModal = document.getElementById('editCategoryModal');
            
            if (event.target === addModal) {
                addModal.classList.add('hidden');
            }
            if (event.target === editModal) {
                editModal.classList.add('hidden');
            }
        }

        // Close modals with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.getElementById('addCategoryModal').classList.add('hidden');
                document.getElementById('editCategoryModal').classList.add('hidden');
            }
        });
    </script>
</body>
</html>