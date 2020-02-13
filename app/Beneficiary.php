<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function insurance()
    {
        return $this->hasOneThrough('App\Insurance', 'App\Insured');
    }
}
