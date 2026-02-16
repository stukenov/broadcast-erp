@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Inventory Value</h5>
                    <p class="card-text">${{ number_format($totalInventoryValue, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text">${{ number_format($totalSales, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Purchases</h5>
                    <p class="card-text">${{ number_format($totalPurchases, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h2>Monthly Sales and Purchases</h2>
            <canvas id="monthlySalesPurchasesChart"></canvas>
        </div>
        <div class="col-md-6">
            <h2>Top Selling Items</h2>
            <canvas id="topSellingItemsChart"></canvas>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h2>Low Stock Items</h2>
            <ul class="list-group">
                @foreach($lowStockItems as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->name }}
                        <span class="badge bg-warning rounded-pill">{{ $item->quantity }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>
    // Monthly Sales and Purchases Chart
    var monthlySalesPurchasesCtx = document.getElementById('monthlySalesPurchasesChart').getContext('2d');
    var monthlySalesPurchasesChart = new Chart(monthlySalesPurchasesCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($monthlySales)) !!},
            datasets: [{
                label: 'Sales',
                data: {!! json_encode(array_values($monthlySales)) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.1
            },
            {
                label: 'Purchases',
                data: {!! json_encode(array_values($monthlyPurchases)) !!},
                borderColor: 'rgba(255, 99, 132, 1)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Top Selling Items Chart
    var topSellingItemsCtx = document.getElementById('topSellingItemsChart').getContext('2d');
    var topSellingItemsChart = new Chart(topSellingItemsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topSellingItemsData->keys()) !!},
            datasets: [{
                label: 'Quantity Sold',
                data: {!! json_encode($topSellingItemsData->values()) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection