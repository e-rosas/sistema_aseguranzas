<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    public $fillable = [
        'person_data_id',
        'insuree_id',
    ];
    public static $rules = [
        'person_data_id' => 'required',
        'insuree_id' => 'required',
    ];
    protected $casts = [
        'person_data_id' => 'integer',
        'insuree_id' => 'integer',
    ];

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function insuree()
    {
        return $this->belongsTo('App\Insuree');
    }

    public function fullName()
    {
        return $this->person_data->full_name;
    }
}
