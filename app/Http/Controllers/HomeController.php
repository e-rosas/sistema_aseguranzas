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
        $invoices = Invoice::orderBy('amount_due', 'desc')->get();

        $totals = new CalculateTotalsOfInvoices($invoices);
        $totals->calculateTotals();

        $topInvoices = [];

        for ($i = 0; $i < 10; ++$i) {
            $invoices[$i]->load('person_data');
            array_push($topInvoices, $invoices[$i]);
        }

        return view('dashboard', compact('totals', 'topInvoices'));
    }
}
