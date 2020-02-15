<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
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
        'number' => 'required|numeric',
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
    ];
}
