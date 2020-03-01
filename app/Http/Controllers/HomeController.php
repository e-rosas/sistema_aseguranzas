<?php

namespace App\Http\Controllers;

use App\Actions\CalculateTotalsOfInvoices;
use App\Invoice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $invoices = Invoice::all();

        $totals = new CalculateTotalsOfInvoices($invoices);
        $totals->calculateTotals();

        return view('dashboard', compact('totals'));
    }
}
