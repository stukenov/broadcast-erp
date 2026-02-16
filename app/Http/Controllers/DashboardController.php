<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInventoryValue = Inventory::sum(DB::raw('quantity * price'));
        $totalSales = Sale::sum('total_price');
        $totalPurchases = Purchase::sum('total_price');
        $lowStockItems = Inventory::where('quantity', '<', 10)->get();
        
        $topSellingItems = Sale::select('inventory_id', DB::raw('SUM(quantity) as total_quantity'))
            ->with('inventory')
            ->groupBy('inventory_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        // Data for monthly sales and purchases chart
        $monthlySales = $this->getMonthlyData(Sale::class);
        $monthlyPurchases = $this->getMonthlyData(Purchase::class);

        // Data for top selling items chart
        $topSellingItemsData = $topSellingItems->pluck('total_quantity', 'inventory.name');

        return view('dashboard', compact(
            'totalInventoryValue',
            'totalSales',
            'totalPurchases',
            'lowStockItems',
            'topSellingItems',
            'monthlySales',
            'monthlyPurchases',
            'topSellingItemsData'
        ));
    }

    private function getMonthlyData($model)
    {
        return $model::select(
            DB::raw('SUM(total_price) as total'),
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();
    }
}