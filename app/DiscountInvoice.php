<?php

namespace App;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Eloquent\Model;

class DiscountInvoice extends Model
{
    public $fillable = [
        'invoice_id',
        'discount_id',
        'start_date',
        'end_date',
        'active',
        'discounted_total',
    ];
    public static $rules = [
        'invoice_id' => 'required',
        'discount_id' => 'required',
        'start_date' => 'date|required',
        'end_date' => 'date|required',
        'discounted_total' => 'numeric|required|between:0,999999999.999',
        'active' => 'boolean',
    ];
    protected $with = ['discount'];
    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'discount_id' => 'integer',
        'active' => 'boolean',
        'discounted_total' => 'decimal:13',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function getDiscountedTotalAttribute($value)
    {
        return number_format($value, 3);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->toDateTimeString();
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::parse($value)->toDateTimeString();
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
