<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['user', 'inventory']);

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $sales = $query->orderBy('created_at', 'desc')->get();
        $total_sales = $sales->sum('total_price');

        return view('sales.index', compact('sales', 'total_sales'));
    }

    public function create()
    {
        $inventories = Inventory::all();
        return view('sales.create', compact('inventories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $inventory = Inventory::findOrFail($validated['inventory_id']);

        if ($inventory->quantity < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Not enough items in stock.']);
        }

        $sale = new Sale();
        $sale->user_id = auth()->id();
        $sale->inventory_id = $validated['inventory_id'];
        $sale->quantity = $validated['quantity'];
        $sale->total_price = $inventory->price * $validated['quantity'];
        $sale->save();

        $inventory->quantity -= $validated['quantity'];
        $inventory->save();

        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully.');
    }

    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}