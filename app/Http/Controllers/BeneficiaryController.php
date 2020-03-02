<?php

namespace App\Http\Controllers;

use App\Actions\CalculateTotalsOfInvoices;
use App\Beneficiary;
use App\Invoice;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiaries = Beneficiary::with(['person_data', 'insuree.insurer'])->paginate(15);

        return view('beneficiaries.index', compact('beneficiaries'));
        //return view('beneficiaries.index', ['beneficiaries' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beneficiaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiary $beneficiary)
    {
        $beneficiary->load('insuree.person_data');
        $invoices = Invoice::where('person_data_id', '=', $beneficiary->person_data->id)->paginate(5);
        $totals = new CalculateTotalsOfInvoices($invoices);
        $totals->calculateTotals();

        return view('beneficiaries.show', compact('beneficiary', 'invoices', 'totals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiary $beneficiary)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiary $beneficiary)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiary $beneficiary)
    {
    }
}
