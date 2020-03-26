<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentChartRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        return view('charts.index');
    }

    public function payments(PaymentChartRequest $request)
    {
        /* $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date); */

        $validated = $request->validated();

        $fromDate = $validated['start_date'];
        $toDate = $validated['end_date'];

        $payments = DB::table('payments')
            ->select(['date', DB::raw('(COUNT(*)) as total_payments'),  DB::raw('(SUM(amount)) as total_amount_paid')])
            ->orderBy('date')
            ->groupBy(DB::raw('MONTH(date)'))
            ->havingRaw(
                '(date >= ? AND date <= ?)',
                [$fromDate.' 00:00:00', $toDate.' 23:59:59']
            )
            ->get()
        ;

        foreach ($payments as $payment) {
            $date = new Carbon($payment->date);
            $payment->date = $date->format('M');
        }

        return json_encode($payments);
    }
}
