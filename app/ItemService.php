<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemService extends Model
{
    public $fillable = [
        'invoice_service_id',
        'item_id',
        'price',
        'discounted_price',
        'quantity',
    ];
    public static $rules = [
        'invoice_service_id' => 'required',
        'item_id' => 'required',
        'price' => 'numeric|required|between:0,999999999.999',
        'discounted_price' => 'numeric|required|between:0,999999999.999',
        'quantity' => 'required',
    ];
    protected $casts = [
        'id' => 'integer',
        'invoice_service_id' => 'integer',
        'item_id' => 'integer',
        'price' => 'decimal:13',
        'discounted_price' => 'decimal:13',
        'quantity' => 'integer',
    ];

    public function getPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getDiscountedPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function invoice_service()
    {
        return $this->belongsTo('App\InvoiceService');
    }
}
