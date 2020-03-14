<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonStats extends Model
{
    public $fillable = [
        'status',
        'amount_paid',
        'amount_due',
        'person_data_id',
    ];
    protected $casts = [
        'person_data_id' => 'integer',
        'status' => 'string',
        'amount_paid' => 'decimal:13',
        'amount_due' => 'decimal:13',
    ];

    /**
     * Get the value of amount_due.
     */
    public function getAmount_due()
    {
        return number_format($this->amount_due, 3);
    }

    /**
     * Get the value of amount_paid.
     */
    public function getAmount_paid()
    {
        return number_format($this->amount_paid, 3);
    }

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }
}
