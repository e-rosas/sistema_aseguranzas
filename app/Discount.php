<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use SoftDeletes;
    public $fillable = [
        'percentage_increase',
        'range_of_days',
        'amount_of_days',
    ];
    public static $rules = [
        'percentage_increase' => 'required|between:0,99.99',
        'range_of_days' => 'required',
        'amount_of_days' => 'numeric|required',
    ];
    protected $casts = [
        'id' => 'integer',
        'range_of_days' => 'string',
        'amount_of_days' => 'integer',
    ];
}
