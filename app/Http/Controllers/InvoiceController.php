<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceService;
use App\ItemService;
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
        if (is_null($request['search'])) {
            $search = '';
        } else {
            $search = $request['search'];
        }
        $year = $request['year'];
        if ($year > 0) {
            $invoices = Invoice::where('year', $year)
                ->whereLike(['number', 'person_data.name', 'person_data.last_name', 'person_data.maiden_name'], $search)
                ->paginate()
        ;
        } else {
            $invoices = Invoice::whereLike(['number', 'person_data.name', 'person_data.last_name', 'person_data.maiden_name'], $search)
                ->paginate()
        ;
        }

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
        $invoice = $invoice->load('services.service');

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
    public function update(Request $request)
    {
        $validated = $this->validateInvoice();
        $invoice = Invoice::findOrFail($request->invoice_id);
        $invoice->fill($validated);
        InvoiceService::where('invoice_id', $invoice->id)->delete();
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

        $invoice->save();

        return route('invoices.show', [$invoice]);
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

    public function searchNumber(Request $request)
    {
        $search = $request->search;
        $invoices = Invoice::query()
            ->where('person_data_id', $request->person_data_id)
            ->whereLike('number', $search)
            ->get()->take(8)
        ;
        $response = [];
        foreach ($invoices as $invoice) {
            $response[] = [
                'id' => $invoice->id,
                'text' => $invoice->number.' '.$invoice->date->format('m-d-y'),
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function year()
    {
        $invoices = Invoice::where('id', '<=', 959)->get();
        foreach ($invoices as $invoice) {
            $services = InvoiceService::where('invoice_id', $invoice->id)->get();
            foreach ($services as $service) {
                $service->created_at = $invoice->date;
                $service->save();
            }
            $invoice->year = $invoice->date->year;
            $invoice->save();
        }
    }

    public function yearBefore()
    {
        $invoices = Invoice::where('id', '>=', 960)->get();
        foreach ($invoices as $invoice) {
            $service = InvoiceService::where('invoice_id', $invoice->id)->first();
            $invoice->year = $service->created_at->year;
            $invoice->save();
        }
    }

    protected function validateInvoice()
    {
        return request()->validate(Invoice::$rules);
    }
}
