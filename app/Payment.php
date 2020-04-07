<?php

namespace App;

use App\Events\PaymentEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    use Notifiable;
    public $fillable = [
        'amount',
        'number',
        'comments',
        'date',
        'date_service',
        'person_data_id',
        'invoice_id',
    ];
    public static $rules = [
        'amount' => 'required|numeric|between:0,999999999.999',
        'comments' => 'max:1000',
        'number' => 'required',
        'date' => 'date',
        'date_service' => 'date',
        'person_data_id' => 'required',
        'invoice_id' => 'required',
    ];
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => PaymentEvent::class,
        'updated' => PaymentEvent::class,
        'deleted' => PaymentEvent::class,
    ];
    protected $casts = [
        'id' => 'integer',
        'person_data_id' => 'integer',
        'comments' => 'string',
        'amount' => 'decimal:13',
        'number' => 'string',
    ];

    protected $dates = ['date', 'date_service'];

    public function getAmountAttribute($value)
    {
        return number_format($value, 3);
    }

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
