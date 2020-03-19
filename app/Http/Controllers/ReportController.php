<?php

namespace App\Http\Controllers;

use App\DiscountPersonData;
use App\Invoice;
use App\PersonData;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function personInvoicesReport(Request $request)
    {
        $person_data_id = $request['person_data_id'];

        $person = PersonData::with('person_stats')->where('id', $person_data_id)->first();
        $invoices = Invoice::with('services')
            ->orderBy('date', 'desc')
            ->where('person_data_id', $person_data_id)->get();
        $discount_person = DiscountPersonData::
                where([
                    ['person_data_id', $person_data_id],
                    ['active', 1],
                ])->first();

        $now = new Carbon();
        $now = $now->subHours(7);
        $datetime = $now->toDayDateTimeString();

        view()->share([
            'person' => $person,
            'invoices' => $invoices,
            'discount' => $discount_person,
            'datetime' => $datetime
        ]);
        $pdf = PDF::loadView('pdf.invoices');
        return $pdf->download();
    }
}
