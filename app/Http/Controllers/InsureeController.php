<?php

namespace App\Http\Controllers;

use App\Actions\CalculatePersonStats;
use App\Actions\CalculateTotalsOfInvoices;
use App\Beneficiary;
use App\Insuree;
use App\Insurer;
use App\Invoice;
use App\PersonData;
use App\PersonStats;
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
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Insuree $insuree)
    {
        $beneficiaries = Beneficiary::with('person_data')->where('insuree_id', '=', $insuree->id)->paginate(5);
        $stats = PersonStats::where('person_data_id', $insuree->person_data->id)->first();

        $invoices = Invoice::with('services')
            ->where('person_data_id', $insuree->person_data->id)
            ->paginate(5);

        return view('insurees.show', compact('insuree', 'beneficiaries', 'stats', 'invoices'));
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
