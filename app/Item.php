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
        'category_id',
    ];
    public static $rules = [
        'code' => 'required|max:255',
        'description' => 'required|max:255',
        'type' => 'max:255',
        'SAT' => 'max:255',
        'price' => 'numeric|required|between:0,999999999.999',
        'discounted_price' => 'numeric|required|between:0,999999999.999|lte:price',
        'tax' => 'boolean',
        'category_id' => 'required|numeric',
    ];
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'description' => 'string',
        'type' => 'string',
        'SAT' => 'string',
        'price' => 'decimal:13',
        'discounted_price' => 'decimal:13',
        'tax' => 'boolean',
        'category_id' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getDiscountedPriceAttribute($value)
    {
        return number_format($value, 3);
    }
}
