<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Auth;

class AIController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function generateText()
    {

        $user = Auth::user();
        $totalExpenses = Expense::where('user_id', Auth::id())->sum('amount');
        $monthlyIncome = $user->monthly_salary ?? 0;
        // dd($monthlyIncome);

        $prompt = "As a financial advisor, analyze this situation and provide one specific, actionable tip (max 20 words):
        - Monthly Income: {$monthlyIncome} DH
        - Total Expenses: {$totalExpenses} DH
        - Current Budget: {$user->budget} DH
        
        Focus on practical savings advice or expense reduction strategies.";

        $response = $this->geminiService->generateResponse($prompt);
        return $response['candidates'][0]['content']['parts'][0]['text'];
    }
}
