<?php

namespace App\Http\Controllers;

use App\DiscountPersonData;
use App\Http\Requests\ApplyDiscountRequest;
use App\Http\Requests\UpdateAppliedDiscountRequest;
use App\Http\Resources\DiscountResource;
use App\PersonStats;
use Illuminate\Http\Request;

class DiscountsPersonController extends Controller
{
    public function addDiscount(ApplyDiscountRequest $request)
    {
        $validated = $request->validated();
        $person_stats = PersonStats::find($validated['person_data_id']);
        if (1 != $person_stats->status) { //1 = personal discount already applied
            DiscountPersonData::create($validated);
            $person_stats->status = 1;
            $person_stats->personal_amount_due = $validated['discounted_total'];
            $person_stats->save();
            $discounts = DiscountPersonData::where('person_data_id', $validated['person_data_id'])->paginate(5);

            return DiscountResource::collection($discounts);
        }
    }

    public function update(UpdateAppliedDiscountRequest $request)
    {
        $validated = $request->validated();
        $id = $validated['discount_person_data_id'];
        $discount = DiscountPersonData::find($id);
        $discount->fill($validated);
        $discount->save();

        $discounts = DiscountPersonData::where('person_data_id', $validated['person_data_id'])
            ->paginate(5)
        ;

        return discountResource::collection($discounts);
    }

    public function delete(Request $request)
    {
        $discount = DiscountPersonData::find($request['discount_person_data_id']);
        $person_data_id = $discount->person_data_id;
        $discount->delete();

        $discounts = DiscountPersonData::where('person_data_id', $person_data_id)
            ->paginate(5)
        ;

        return discountResource::collection($discounts);
    }

    public function find(Request $request)
    {
        $discount = DiscountPersonData::findOrFail($request->discount_id);

        return new DiscountResource($discount);
    }
}
