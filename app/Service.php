<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    public $fillable = [
        'code',
        'description',
        'price',
        'discounted_price',
    ];
    public static $rules = [
        'code' => 'required|max:255',
        'description' => 'required|max:255',
        'price' => 'numeric|required|between:0,999999999.999',
        'discounted_price' => 'numeric|required|between:0,999999999.999',
    ];
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'description' => 'string',
        'price' => 'decimal:13',
        'discounted_price' => 'decimal:13',
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
