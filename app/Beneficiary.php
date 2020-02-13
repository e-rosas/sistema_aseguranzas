<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function insured()
    {
        return $this->belongsTo('App\Insured');
    }

    public function fullName()
    {
        return $this->person_data->last_name.' '.$this->person_data->maiden_name.' '.$this->person_data->name;
    }
}
