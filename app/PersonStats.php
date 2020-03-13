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

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }
}
