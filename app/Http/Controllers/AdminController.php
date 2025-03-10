<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function checkAdminAccess()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }
    }

    public function dashboard()
    {
        if ($response = $this->checkAdminAccess()) {
            return $response;
        }

        $users = User::where('role', '!=', 'admin')->get();
        $categories = Category::all();
        $totalUsers = $users->count();
        $totalCategories = $categories->count();

        return view('admin.admin', compact('users', 'categories', 'totalUsers', 'totalCategories'));
    }

    public function storeCategory(Request $request)
    {
        if ($response = $this->checkAdminAccess()) {
            return $response;
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string'
        ]);

        Category::create($validated);
        return redirect()->back()->with('success', 'Category created successfully');
    }

    public function updateCategory(Request $request, Category $category)
    {
        if ($response = $this->checkAdminAccess()) {
            return $response;
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string'
        ]);

        $category->update($validated);
        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function deleteCategory(Category $category)
    {
        if ($response = $this->checkAdminAccess()) {
            return $response;
        }

        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    public function deleteUser(User $user)
    {
        if ($response = $this->checkAdminAccess()) {
            return $response;
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
