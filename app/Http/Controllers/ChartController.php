<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentChartRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function payments(PaymentChartRequest $request)
    {
        /* $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date); */

        $validated = $request->validate();

        $fromDate = $validated['start_date'];
        $toDate = $validated['end_date'];

        $payments = DB::table("payments")
            ->select("id", DB::raw("(COUNT(*)) as total_payments"))
            ->orderBy('created_at')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->havingRaw(
                "(created_at >= ? AND created_at <= ?)",
                [$fromDate." 00:00:00", $toDate." 23:59:59"]
            )
            ->get();
        dd($payments);
    }
}
