<?php

namespace App\Http\Controllers;

use App\Actions\CalculateTotalsOfInvoices;
use App\Beneficiary;
use App\Insuree;
use App\Insurer;
use App\PersonData;
use Illuminate\Http\Request;

class InsureeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insurees = \App\Insuree::with(['person_data', 'insurer'])->paginate(15);

        return view('insurees.index', compact('insurees'));
        //return view('insurees.index', ['insurees' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurers = Insurer::take(10)->get();

        return view('insurees.create', compact('insurers'));
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
    public function show(Insuree $insuree)
    {
        $beneficiaries = Beneficiary::with('person_data.invoices')->where('insuree_id', '=', $insuree->id)->paginate(5);
        $insuree->person_data->load('invoices');

        $totals = new CalculateTotalsOfInvoices($insuree->person_data->invoices);
        foreach ($beneficiaries as $beneficiary) {
            $totals->addInvoices($beneficiary->person_data->invoices);
        }
        $totals->calculateTotals();

        return view('insurees.show', compact('insuree', 'beneficiaries', 'totals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Insuree $Insuree)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insuree $Insuree)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insuree $Insuree)
    {
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $insurees = PersonData::query()
            ->whereLike('name', $search)
            ->whereLike('last_name', $search)
            ->whereLike('maiden_name', $search)
            ->get()->take(5)
        ;
        $response = [];
        foreach ($insurees as $insuree) {
            $response[] = [
                'id' => $insuree->id,
                'text' => $insuree->fullName(),
            ];
        }
        echo json_encode($response);
        exit;
    }
}
