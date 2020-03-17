<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Payment;
use App\person_stats;
use App\PersonStats;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validatePayment();

        //New action: Verify that paid amount does not exceed it's respective person_stats due amount
        $person_stats = PersonStats::find($validated['person_data_id']);

        $person_stats->amount_paid += (float) $validated['amount'];

        if ($person_stats->amount_due < ($person_stats->amount_paid)) {
            return ['error' => 'Amount paid of person_stats exceeds amount due with this payment.'];
        }

        Payment::create($validated);

        $payments = Payment::where('person_data_id', $request->person_data_id)->paginate(5);

        //new action: Add paid amount, calculate amount due
        $person_stats->amount_due -= (float) $validated['amount'];
        $person_stats->save();

        return PaymentResource::collection($payments);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
    }

    public function validatePayment()
    {
        return request()->validate(Payment::$rules);
    }
}
