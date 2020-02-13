<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insured extends Model
{
    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function beneficiaries()
    {
        return $this->hasMany('App\Beneficiary');
    }

    public function insurance()
    {
        return $this->belongsTo('App\Insurance');
    }

    public function fullName()
    {
        return $this->person_data->last_name.' '.$this->person_data->maiden_name.' '.$this->person_data->name;
    }
}
