<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    public $fillable = [
        'number',
        'comments',
        'status',
        'invoice_id',
        'claim',
        'date',
        'person_data_id',
    ];
    public static $rules = [
        'number' => 'required',
        'comments' => 'max:1000',
        'status' => 'max:250',
        'invoice_id' => 'required',
        'date' => 'date',
        'claim' => 'max:255',
        'person_data_id' => 'required',
    ];
    protected $casts = [
        'id' => 'integer',
        'person_data_id' => 'integer',
        'comments' => 'string',
        'claim' => 'string',
        'number' => 'string',
    ];

    protected $dates = ['date'];

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
