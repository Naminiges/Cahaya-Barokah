<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function view(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $reports = DB::table('vw_financial_report')
            ->whereBetween('transaction_date', [$validated['start_date'], $validated['end_date']])
            ->orderBy('transaction_date')
            ->get();

        $summary = [
            'total_sales' => $reports->sum('total_sales_amount'),
            'total_purchases' => $reports->sum('total_purchase_amount'),
            'total_profit' => $reports->sum('profit'),
            'total_transactions' => $reports->sum('total_sales_transactions') + $reports->sum('total_purchase_transactions')
        ];

        return view('report.view', compact('reports', 'summary', 'validated'));
    }

    public function print(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $reports = DB::table('vw_financial_report')
            ->whereBetween('transaction_date', [$validated['start_date'], $validated['end_date']])
            ->orderBy('transaction_date')
            ->get();

        $summary = [
            'total_sales' => $reports->sum('total_sales_amount'),
            'total_purchases' => $reports->sum('total_purchase_amount'),
            'total_profit' => $reports->sum('profit'),
            'total_transactions' => $reports->sum('total_sales_transactions') + $reports->sum('total_purchase_transactions')
        ];

        return view('report.print', compact('reports', 'summary', 'validated'));
    }
}