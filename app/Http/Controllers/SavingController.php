<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Saving;

class SavingController extends Controller
{
    public function index()
    {
        $savingGoal = Saving::where('user_id', Auth::id())->first(); 

        return view('goals', compact('savingGoal'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'monthly_contribution' => 'required|numeric|min:0',
        ]);

        // Create a new saving entry for the authenticated user
        $saving = new Saving();
        $saving->user_id = Auth::id();
        $saving->monthly_contribution = $request->monthly_contribution;
        $saving->current_amount = $request->current_amount;
        $saving->save();

        // Redirect or return a response
        return redirect()->route('goals.index')->with('success', 'Saving created successfully!');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'monthly_contribution' => 'required|numeric|min:0',
        ]);

        // Find the saving entry
        $saving = Saving::findOrFail($id);
        $saving->monthly_contribution = $request->monthly_contribution;
        $saving->save();

        // Redirect or return a response
        return redirect()->route('goals.index')->with('success', 'Monthly contribution updated successfully!');
    }

    public function addExtraContribution(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'extra_contribution' => 'required|numeric|min:0',
        ]);

        // Find the saving entry
        $saving = Saving::findOrFail($id);
        
        $saving->monthly_contribution += $request->extra_contribution; 
        $saving->save();

        return redirect()->route('goals.index')->with('success', 'Monthly contribution updated successfully!');
    }
}
