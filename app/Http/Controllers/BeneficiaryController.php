<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Invoice;
use App\PersonStats;
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
        $beneficiaries = Beneficiary::with(['person_data', 'insuree.person_data', 'insuree.insurer'])->paginate(15);

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

    public function update(Request $request)
    {
        $beneficiary = Beneficiary::findOrFail($request->beneficiary_id);
        $beneficiary->insuree_id = $request->insuree_id;
        $beneficiary->save();

        return json_encode($beneficiary);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiary $beneficiary)
    {
        $beneficiary->loadMissing('insuree.person_data');

        $invoices = Invoice::with('services')
            ->where('person_data_id', $beneficiary->person_data->id)
            ->paginate(5)
        ;

        $stats = PersonStats::where('person_data_id', $beneficiary->person_data->id)->first();

        return view('beneficiaries.show', compact('beneficiary', 'stats', 'invoices'));
    }
}
