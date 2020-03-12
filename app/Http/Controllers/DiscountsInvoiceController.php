<?php

namespace App\Http\Controllers;

use App\DiscountPersonData;
use App\Http\Requests\ApplyDiscountRequest;

class DiscountsInvoiceController extends Controller
{
    public function addDiscount(ApplyDiscountRequest $request)
    {
        $validated = $request->validated();
        DiscountPersonData::create($validated);
        $response = [
            'success' => true,
            'message' => 'Registered successfully.',
        ];

        return response()->json($response, 200);
    }

    public function validateAppliedDiscount()
    {
    }
}
