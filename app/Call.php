<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    public $fillable = [
        'number',
        'comments',
        'claim',
        'date',
        'invoice_id',
    ];
    public static $rules = [
        'number' => 'required',
        'comments' => 'max:1000',
        'date' => 'date',
        'claim' => 'max:255',
        'invoice_id' => 'required',
    ];
    protected $casts = [
        'id' => 'integer',
        'invoicenumber' => 'string',
        'comments' => 'string',
        'claim' => 'string',
    ];

    protected $dates = ['date'];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
