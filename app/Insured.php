<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insured extends Model
{
    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function insurance()
    {
        return $this->belongsTo('App\Insurance');
    }
}
