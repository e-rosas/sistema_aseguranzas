<?php

namespace App\Http\Controllers;

use App\Discount;
use App\DiscountInvoice;
use App\Http\Resources\DiscountResource;
use Illuminate\Http\Request;

class DiscountsInvoiceController extends Controller
{
    public function addAppliedDiscounts(Request $request)
    {
        foreach ($request->appliedDiscounts as $applied_discount) {
            DiscountInvoice::create($applied_discount);
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
