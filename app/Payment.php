<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $fillable = [
        'amount',
        'comments',
        'date',
        'invoice_id',
    ];
    public static $rules = [
        'amount' => 'required|numeric|between:0,999999999.999',
        'comments' => 'max:1000',
        'date' => 'date',
        'invoice_id' => 'required',
    ];
    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'comments' => 'string',
        'amount' => 'decimal:13',
    ];

    protected $dates = ['date'];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
