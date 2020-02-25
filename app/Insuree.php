<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insuree extends Model
{
    public $fillable = [
        'person_data_id',
        'insurer_id',
        'insurance_id',
    ];
    public static $rules = [
        'person_data_id' => 'required',
        'insurer_id' => 'required',
        'insurance_id' => 'required|max:255',
    ];
    protected $with = ['person_data'];
    protected $casts = [
        'person_data_id' => 'integer',
        'insurer_id' => 'integer',
        'insurance_id' => 'string',
    ];

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function beneficiaries()
    {
        return $this->hasMany('App\Beneficiary');
    }

    public function insurer()
    {
        return $this->belongsTo('App\Insurer');
    }

    public function fullName()
    {
        $data = $this->person_data;

        return $data->last_name.' '.$data->maiden_name.' '.$data->name;
    }
}
