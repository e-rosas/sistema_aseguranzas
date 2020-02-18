<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    public $fillable = [
        'name',
        'code',
        'address',
        'city',
        'state',
        'postal_code',
        'phone_number',
        'email',
    ];

    public static $rules = [
        'name' => 'required|min:10|max:255',
        'address' => 'max:255',
        'city' => 'max:255',
        'state' => 'max:255',
        'postal_code' => 'digits:5',
        'phone_number' => 'required|max:255',
        'email' => 'email',
        'code' => 'max:255',
    ];

    public function insurees()
    {
        return $this->hasMany('App\Insuree');
    }

    public function addressDetails()
    {
        return $this->city.', '.$this->state.'.  '.$this->postal_code;
    }
}
