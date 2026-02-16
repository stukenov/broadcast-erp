<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $query = Purchase::with(['user', 'inventory']);

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $purchases = $query->orderBy('created_at', 'desc')->get();
        $total_purchases = $purchases->sum('total_price');

        return view('purchases.index', compact('purchases', 'total_purchases'));
    }

    public function create()
    {
        $inventories = Inventory::all();
        return view('purchases.create', compact('inventories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $inventory = Inventory::findOrFail($validated['inventory_id']);

        $purchase = new Purchase();
        $purchase->user_id = auth()->id();
        $purchase->inventory_id = $validated['inventory_id'];
        $purchase->quantity = $validated['quantity'];
        $purchase->total_price = $validated['price'] * $validated['quantity'];
        $purchase->save();

        $inventory->quantity += $validated['quantity'];
        $inventory->save();

        return redirect()->route('purchases.index')->with('success', 'Purchase recorded successfully.');
    }

    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}