<?php

namespace App\Http\Controllers;

use App\Call;
use App\Http\Resources\CallResource;
use Illuminate\Http\Request;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calls = \App\Call::with(['invoice.person_data'])->paginate(15);

        return view('calls.index', compact('calls'));
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
        $validated = $this->validateCall();
        Call::create($validated);

        return $this->getInvoiceCalls($request->invoice_id);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Call $call)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Call $call)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $this->validateCall();
        $id = $request->id;
        $call = Call::find($id);
        $call->fill($validated);
        $call->save();

        return $this->getInvoiceCalls($call->invoice_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Call $call)
    {
    }

    public function validateCall()
    {
        return request()->validate(Call::$rules);
    }

    public function find(Request $request)
    {
        $call = Call::findOrFail($request->id);

        CallResource::withoutWrapping();

        return new CallResource($call);
    }

    private function getInvoiceCalls($invoice_id)
    {
        $calls = Call::where('invoice_id', $invoice_id)->paginate(3);

        return CallResource::collection($calls);
    }
}
