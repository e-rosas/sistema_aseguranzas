<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $fillable = [
        'amount',
        'number',
        'comments',
        'date',
        'invoice_id',
    ];
    public static $rules = [
        'amount' => 'required|numeric|between:0,999999999.999',
        'comments' => 'max:1000',
        'number' => 'required',
        'date' => 'date',
        'invoice_id' => 'required',
    ];
    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'comments' => 'string',
        'amount' => 'decimal:13',
        'number' => 'string',
    ];

    protected $dates = ['date'];

    public function getAmountAttribute($value)
    {
        return number_format($value, 3);
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
