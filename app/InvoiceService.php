<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceService extends Model
{
    public $fillable = [
        'invoice_id',
        'service_id',
        'price',
        'discounted_price',
        'description',
        'quantity',
    ];
    public static $rules = [
        'invoice_id' => 'required',
        'service_id' => 'required',
        'price' => 'numeric|required|between:0,999999999.999',
        'discounted_price' => 'numeric|required|between:0,999999999.999',
        'description' => 'max:255',
        'quantity' => 'numeric|required',
    ];
    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'service_id' => 'integer',
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

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function items()
    {
        return $this->hasMany('App\ItemService');
    }
}
