@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Financial Report for {{ $currentMonth }}</h1>
    
    <div class="row">
        <div class="col-md-6">
            <h3>Income</h3>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Sales
                    <span>${{ number_format($sales, 2) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Other Income
                    <span>${{ number_format($otherIncome, 2) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Total Income</strong>
                    <span>${{ number_format($totalIncome, 2) }}</span>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <h3>Expenses</h3>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Purchases
                    <span>${{ number_format($purchases, 2) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Other Expenses
                    <span>${{ number_format($otherExpenses, 2) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Total Expenses</strong>
                    <span>${{ number_format($totalExpenses, 2) }}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Net Profit: ${{ number_format($netProfit, 2) }}</h3>
        </div>
    </div>
</div>
@endsection