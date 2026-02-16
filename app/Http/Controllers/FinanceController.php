<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Finance::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('date', [$start_date, $end_date]);
        }

        $finances = $query->orderBy('date', 'desc')->get();
        $total_income = $finances->where('type', 'income')->sum('amount');
        $total_expense = $finances->where('type', 'expense')->sum('amount');
        $net_profit = $total_income - $total_expense;

        return view('finances.index', compact('finances', 'total_income', 'total_expense', 'net_profit'));
    }

    public function create()
    {
        return view('finances.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        Finance::create($validated);

        return redirect()->route('finances.index')->with('success', 'Financial record added successfully.');
    }

    public function show(Finance $finance)
    {
        return view('finances.show', compact('finance'));
    }

    public function edit(Finance $finance)
    {
        return view('finances.edit', compact('finance'));
    }

    public function update(Request $request, Finance $finance)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        $finance->update($validated);

        return redirect()->route('finances.index')->with('success', 'Financial record updated successfully.');
    }

    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances.index')->with('success', 'Financial record deleted successfully.');
    }

    public function report()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $sales = Sale::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_price');
        $purchases = Purchase::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_price');
        $otherIncome = Finance::where('type', 'income')
            ->whereYear('date', Carbon::now()->year)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('amount');
        $otherExpenses = Finance::where('type', 'expense')
            ->whereYear('date', Carbon::now()->year)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('amount');

        $totalIncome = $sales + $otherIncome;
        $totalExpenses = $purchases + $otherExpenses;
        $netProfit = $totalIncome - $totalExpenses;

        return view('finances.report', compact('currentMonth', 'sales', 'purchases', 'otherIncome', 'otherExpenses', 'totalIncome', 'totalExpenses', 'netProfit'));
    }
}