<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    public $patient;
    public $fillable = [
        'number',
        'comments',
        'state',
        'date',
        'total',
        'total_with_discounts',
        'amount_paid',
    ];
    public static $rules = [
        'number' => 'required',
        'state' => 'max:255',
        'date' => 'date',
        'total' => 'numeric|required|between:0,999999999.999',
        'total_with_discounts' => 'numeric|required|between:0,999999999.999',
        'amount_paid' => 'numeric|between:0,999999999.999',
    ];
    protected $casts = [
        'id' => 'integer',
        'person_data_id' => 'integer',
        'number' => 'string',
        'date' => 'date',
        'comments' => 'string',
        'state' => 'string',
        'total' => 'decimal:13',
        'total_with_discounts' => 'decimal:13',
        'amount_paid' => 'decimal:13',
    ];

    protected $dates = ['date'];

    public function getTotalAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getTotalWithDiscountsAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getAmountPaidAttribute($value)
    {
        return number_format($value, 3);
    }

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }
}
