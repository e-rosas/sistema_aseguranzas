<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Payment;
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
        $payments = Payment::with('person_data', 'invoice')
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return view('payments.index', compact('payments'));
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

        Payment::create($validated);

        $payments = Payment::with('invoice')
            ->where('person_data_id', $request->person_data_id)
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return PaymentResource::collection($payments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request)
    {
        $validated = $request->validated();
        $id = $validated['payment_id'];

        $payment = Payment::findOrFail($id);
        $payment->fill($validated);
        $payment->save();

        $payments = Payment::with('invoice')->where('person_data_id', $request['person_data_id'])
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return PaymentResource::collection($payments);
    }

    public function delete(Request $request)
    {
        $payment = Payment::find($request['payment_id']);
        $person_data_id = $payment->person_data_id;
        $payment->delete();

        $payments = Payment::with('invoice')->where('person_data_id', $person_data_id)
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return PaymentResource::collection($payments);
    }

    public function find(Request $request)
    {
        $payment = Payment::findOrFail($request->payment_id);

        return new PaymentResource($payment);
    }

    public function validatePayment()
    {
        return request()->validate(Payment::$rules);
    }
}
