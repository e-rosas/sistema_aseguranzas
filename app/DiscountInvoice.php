<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountInvoice extends Model
{
    public $fillable = [
        'invoice_id',
        'discount_id',
        'start_date',
        'end_date',
        'status',
        'discounted_total',
    ];
    public static $rules = [
        'invoice_id' => 'required',
        'discount_id' => 'required',
        'start_date' => 'date|required',
        'end_date' => 'date|required',
        'discounted_total' => 'numeric|required|between:0,999999999.999',
        'status' => 'max:255',
    ];
    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'discount_id' => 'integer',
        'status' => 'string',
        'discounted_total' => 'decimal:13',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function getDiscountedTotalAttribute($value)
    {
        return number_format($value, 3);
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function discount()
    {
        return $this->belongsTo('App\Discount');
    }
}
