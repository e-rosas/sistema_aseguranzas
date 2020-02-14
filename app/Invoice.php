<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    public $fillable = [
        'code',
        'description',
        'total',
    ];
    public static $rules = [
        'code' => 'numeric',
        'description' => 'required|max:255',
        'total' => 'numeric|required|between:0,999999999.999',
    ];
    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
        'description' => 'string',
    ];
}
