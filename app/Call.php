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
        'person_data_id',
    ];
    public static $rules = [
        'number' => 'required',
        'comments' => 'max:1000',
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
}
