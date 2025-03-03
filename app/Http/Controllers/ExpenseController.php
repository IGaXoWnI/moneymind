<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense; // Make sure to create this model
use App\Models\Category; // Make sure to create this model

class ExpenseController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'is_fixed' => 'required|in:yes,no',
            'next_date' => 'nullable|date',
        ]);
    
        Expense::create([
            'user_id' => Auth::id(), // This should not be null if the user is authenticated
            'name' => $validated['name'],
            'description' => $validated['description'],
            'amount' => $validated['amount'],
            'category_id' => $validated['category_id'],
            'date' => $validated['date'],
            'next_date' => $validated['is_fixed'] === 'yes' ? $validated['next_date'] : null,
        ]);
    
        return redirect()->route('dashboard')->with('status', 'Expense added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->name = $request->name;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->category_id = $request->category_id;
        $expense->date = $request->date;
        $expense->save();

        return redirect()->route('dashboard')->with('status', 'Expense updated successfully!');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('dashboard')->with('status', 'Expense deleted successfully!');
    }

    public function index()
    {
        $expenses = Expense::where('user_id', Auth::id())->get();
        return view('dashboard', compact('expenses'));
    }

    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('expenses.create', compact('categories')); // Pass categories to the view
    }
}
