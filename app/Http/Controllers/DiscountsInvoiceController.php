<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Http\Resources\DiscountResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiscountsInvoiceController extends Controller
{
    public function addAppliedDiscounts(Request $request)
    {
        foreach ($request as $r) {
            Log::info('request: '.$r->appliedDiscounts);
        }
    }

    public function discounts()
    {
        return DiscountResource::collection(Discount::paginate(5));
    }

    public function validateAppliedDiscount()
    {
    }
}
