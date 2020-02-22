<?php

namespace App\Http\Controllers;

use App\Discount;
use App\DiscountInvoice;
use App\Http\Resources\DiscountResource;
use App\Invoice;
use Illuminate\Http\Request;

class DiscountsInvoiceController extends Controller
{
    public function addAppliedDiscounts(Request $request)
    {
        foreach ($request->appliedDiscounts as $applied_discount) {
            DiscountInvoice::create($applied_discount);
        }
        $invoice_id = $request->appliedDiscounts[0]['invoice_id'];
        $discounts = DiscountInvoice::where('invoice_id', $invoice_id)->paginate(5);
        $invoice = Invoice::find($invoice_id);
        $invoice->status = 'with benefits';
        $invoice->save();

        return response()->json($discounts);
    }

    public function discounts()
    {
        return DiscountResource::collection(Discount::paginate(5));
    }

    public function validateAppliedDiscount()
    {
    }
}
