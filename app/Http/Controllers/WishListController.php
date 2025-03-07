<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishListController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        $completedItems = Wishlist::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->get();

        $totalItems = $wishlistItems->count();
        $totalWishlistValue = $wishlistItems->sum('estimated_cost');
        $totalSaved = $wishlistItems->sum('saved_amount');
        $monthlyContribution = $wishlistItems->sum('monthly_contribution');

        return view('wishlist', compact(
            'wishlistItems',
            'completedItems',
            'totalItems',
            'totalWishlistValue',
            'totalSaved',
            'monthlyContribution'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'monthly_contribution' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        Wishlist::create([
            'user_id' => Auth::id(),
            'item_name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'estimated_cost' => $validated['price'],
            'monthly_contribution' => $validated['monthly_contribution'],
            'saved_amount' => 0,
            'status' => 'pending'
        ]);

        return redirect()->route('wishlist')->with('success', 'Item added to wishlist');
    }

    public function contribute(Request $request)
    {
        $validated = $request->validate([
            'wishlist_id' => 'required|exists:wishlists,id',
            'amount' => 'required|numeric|min:0'
        ]);

        $wishlist = Wishlist::findOrFail($validated['wishlist_id']);
        $wishlist->saved_amount += $validated['amount'];
        $wishlist->save();

        return redirect()->route('wishlist')->with('success', 'Funds added successfully');
    }

    public function complete(Request $request)
    {
        $validated = $request->validate([
            'wishlist_id' => 'required|exists:wishlists,id'
        ]);

        $wishlist = Wishlist::findOrFail($validated['wishlist_id']);
        $wishlist->status = 'completed';
        $wishlist->purchased_at = now();
        $wishlist->save();

        return redirect()->route('wishlist')->with('success', 'Item marked as purchased');
    }
}
