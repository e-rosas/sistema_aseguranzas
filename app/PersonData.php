<?php

namespace App;

use App\Events\PersonDataCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PersonData extends Model
{
    use Notifiable;
    public $fillable = [
        'last_name',
        'maiden_name',
        'name',
        'full_name',
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
        'last_name' => 'max:120',
        'maiden_name' => 'max:20',
        'name' => 'required|min:2|max:100',
        'full_name' => 'max:250',
        'birth_date' => 'date',
        'address' => 'max:255',
        'city' => 'max:255',
        'state' => 'max:255',
        'postal_code' => 'digits:5',
        'phone_number' => 'max:255',
        'email' => 'max:255',
    ];
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => PersonDataCreated::class,
    ];
    protected $dates = ['birth_date'];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'last_name' => 'string',
        'maiden_name' => 'string',
        'name' => 'string',
        'full_name' => 'string',
        'birth_date' => 'date:Y-m-d',
        'address' => 'string',
        'city' => 'string',
        'state' => 'string',
        'postal_code' => 'integer',
        'phone_number' => 'string',
        'email' => 'string',
        'insured' => 'boolean',
    ];

    public function person_stats()
    {
        return $this->hasOne('App\PersonStats');
    }

    public function insuree()
    {
        return $this->hasOne('App\Insuree');
    }

    public function beneficiary()
    {
        return $this->hasOne('App\Beneficiary');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function person()
    {
        if ($this['insured']) {
            return $this->beneficiary();
        }

        return $this->insuree();
    }

    public function calls()
    {
        return $this->hasMany('App\Call')->orderBy('date', 'desc');
    }

    public function discounts()
    {
        return $this->hasMany('App\DiscountPersonData');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment')->orderBy('date', 'desc');
    }

    public function fullName()
    {
        /* if (!isset($this->maiden_name) || '' === trim($this->maiden_name)) {

        } */
        return $this->last_name.' '.$this->name;
        //return $this->last_name.' '.$this->maiden_name.' '.$this->name;
    }

    public function addressDetails()
    {
        return $this->city.', '.$this->state.'.  '.$this->postal_code;
    }
}
