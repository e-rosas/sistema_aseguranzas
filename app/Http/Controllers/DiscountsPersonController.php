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
            $person_stats->status = 1;
            $person_stats->save();
            DiscountPersonData::create($validated);

            return $this->getPersonDiscounts($validated['person_data_id']);
        }
    }

    public function update(UpdateAppliedDiscountRequest $request)
    {
        $validated = $request->validated();
        $id = $validated['discount_person_data_id'];
        $discount = DiscountPersonData::find($id);
        $person_data_id = $discount->person_data_id;
        $discount->fill($validated);
        $discount->save();

        return $this->getPersonDiscounts($person_data_id);
    }

    public function delete(Request $request)
    {
        $discount = DiscountPersonData::find($request['discount_person_data_id']);
        $discount->expired();

        $person_data_id = $discount->person_data_id;

        $person_stats = PersonStats::find($person_data_id);
        $person_stats->status = 0;
        $person_stats->save();

        $discount->save();

        return $this->getPersonDiscounts($person_data_id);
    }

    public function getPersonDiscounts($person_data_id)
    {
        $discounts = DiscountPersonData::where('person_data_id', $person_data_id)
            ->orderBy('end_date', 'desc')
            ->paginate(15)
        ;

        return DiscountResource::collection($discounts);
    }

    public function find(Request $request)
    {
        $discount = DiscountPersonData::findOrFail($request->discount_id);

        return new DiscountResource($discount);
    }
}
