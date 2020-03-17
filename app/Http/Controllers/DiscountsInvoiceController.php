<?php

namespace App\Http\Controllers;

use App\DiscountPersonData;
use App\Http\Requests\ApplyDiscountRequest;
use App\Http\Resources\DiscountResource;
use App\PersonStats;

class DiscountsInvoiceController extends Controller
{
    public function addDiscount(ApplyDiscountRequest $request)
    {
        $validated = $request->validated();
        $person_stats = PersonStats::find($validated['person_data_id']);
        if (1 != $person_stats->status) { //1 = personal discount already applied
            DiscountPersonData::create($validated);
            $person_stats->status = 1;
            $person_stats->amount_due = $validated->discounted_total;
            $person_stats->save();
            $discounts = DiscountPersonData::where('person_data_id', $validated['person_data_id'])->paginate(5);

            return DiscountResource::collection($discounts);
        }
    }
}
