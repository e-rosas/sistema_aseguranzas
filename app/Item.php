<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $fillable = [
        'code',
        'description',
        'price',
        'discounted_price',
        'type',
        'SAT',
        'tax',
    ];
    public static $rules = [
        'code' => 'numeric',
        'description' => 'required|max:255',
        'type' => 'max:255',
        'SAT' => 'max:255',
        'price' => 'numeric|required|between:0,999999999.999',
        'discounted_price' => 'numeric|required|between:0,999999999.999',
        'tax' => 'boolean',
    ];
    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
        'description' => 'string',
        'type' => 'string',
        'SAT' => 'string',
        'discounted_price' => 'decimal:13',
        'tax' => 'boolean',
    ];

    public function getPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getDiscountedPriceAttribute($value)
    {
        return number_format($value, 3);
    }
}
