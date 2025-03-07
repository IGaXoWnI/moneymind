<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\Category;

class ExpenseController extends Controller
{
    protected $aiController;

    public function __construct(AIController $aiController ){
        $this->aiController = $aiController;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_fixed' => 'required',
            'next_date' => 'nullable|int',
        ]);

        if ($request->input("is_fixed") === 'no') {
            $user = User::find(Auth::id());
            $user->cutExpenses($request->amount);
        }

        Expense::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'description' => $validated['description'],
            'amount' => $validated['amount'],
            'category_id' => $validated['category_id'],
            'is_fixed' => $validated['is_fixed'],
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
        ]);

        $expense = Expense::findOrFail($id);
        $expense->name = $request->name;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->category_id = $request->category_id;
        $expense->save();

        return redirect()->route('dashboard')->with('status', 'Expense updated successfully!');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('dashboard')->with('status', 'Expense deleted successfully!');
    }

    public function index(Request $request)
    {
        $expenses = Expense::with('category')->paginate(10);
        
        $categories = Category::all();

        $totalAmount = $expenses->sum('amount'); 

        $monthlyAverage = $expenses->count() > 0 ? $totalAmount / $expenses->count() : 0;

        $highestExpense = $expenses->max('amount'); 

        return view('expenses.index', compact('expenses', 'categories', 'totalAmount', 'monthlyAverage', 'highestExpense'));
    }

    public function show()
    {
        $expenses = Expense::where('user_id', Auth::id())->paginate(10);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('expenses.create', compact('categories'));
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        $categories = Category::all(); 
        return view('expenses.edit', compact('expense', 'categories')); 
    }

    public function dashboard()
    {
        $expenses = Expense::where('user_id', Auth::id())->get(); 
        $aiSuggestion = $this->aiController->generateText();

        return view('dashboard', compact('expenses' , 'aiSuggestion'));
    }
}
