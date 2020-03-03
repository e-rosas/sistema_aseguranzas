<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceService;
use App\ItemService;
use App\Payment;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = \App\Invoice::with(['person_data'])->paginate(15);

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $invoices = Invoice::whereLike(['number', 'person_data.name', 'person_data.last_name', 'person_data.maiden_name'], $search)
            ->paginate(10)
        ;

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateInvoice();
        $invoice = Invoice::create($validated);

        $services = $request->services;
        foreach ($services as $service) {
            $service['invoice_id'] = $invoice->id;
            $invoice_service = InvoiceService::create($service);
            if (isset($service['items'])) {
                $items = $service['items'];
                foreach ($items as $item) {
                    $item['invoice_service_id'] = $invoice_service->id;
                    ItemService::create($item);
                }
            }
        }

        return route('invoices.show', [$invoice]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $invoice->loadMissing('services');

        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
    }

    public function updatePersonData(Request $request)
    {
        $id = $request->invoice_id;

        $invoice = Invoice::where('id', '=', $id)->first();

        $person_data_id = $request->person_data_id;
        $invoice->person_data_id = $person_data_id;
        $invoice->save();

        return back()->withStatus(__('Invoice successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
    }

    public function getInvoicePayments($invoice_id)
    {
        $payments = Payment::where('invoice_id', $invoice_id)->paginate(4);

        $payments->withPath('payments/url');

        return view('payments.partials.table', ['payments' => $payments])->render();
    }

    protected function validateInvoice()
    {
        return request()->validate(Invoice::$rules);
    }
}
