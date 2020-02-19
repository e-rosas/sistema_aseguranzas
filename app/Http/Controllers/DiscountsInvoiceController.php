<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Http\Resources\DiscountResource;
use Illuminate\Http\Request;

class DiscountsInvoiceController extends Controller
{
    public function add(Request $request)
    {
    }

    public function discounts()
    {
        return DiscountResource::collection(Discount::paginate(5));
    }
}
