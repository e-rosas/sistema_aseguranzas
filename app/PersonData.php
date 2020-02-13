<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonData extends Model
{
    use SoftDeletes;
    public $fillable = [
        'last_name',
        'maiden_name',
        'name',
        'birth_date',
        'address',
        'city',
        'state',
        'postal_code',
        'phone_number',
        'email',
        'insured',
    ];
    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'last_name' => 'max:255',
        'maiden_name' => 'max:255',
        'name' => 'required|max:255',
        'birth_date' => 'required',
        'address' => 'max:255',
        'city' => 'max:255',
        'state' => 'max:255',
        'postal_code' => 'digits:5',
        'phone' => 'max:255',
        'email' => 'email|max:255',
        'insured' => 'boolean',
    ];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'last_nane' => 'string',
        'maiden_name' => 'string',
        'name' => 'string',
        'birth_date' => 'date',
        'address' => 'string',
        'city' => 'string',
        'state' => 'string',
        'postal_code' => 'integer',
        'phone_number' => 'string',
        'email' => 'string',
        'insured' => 'boolean',
    ];

    public function insured()
    {
        return $this->hasOne('App\Insured');
    }

    public function beneficiary()
    {
        return $this->hasOne('App\Beneficiary');
    }
}
