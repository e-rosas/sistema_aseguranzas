<?php

namespace App;

use App\Events\DiscountPersonEvent;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DiscountPersonData extends Model
{
    use Notifiable;
    public $fillable = [
        'person_data_id',
        'discount_percentage',
        'start_date',
        'end_date',
        'active',
        'status',
        'discounted_total',
    ];
    public static $rules = [
        'person_data_id' => 'required',
        'discount_percentage' => 'required|between:0,99.99',
        'start_date' => 'date|required',
        'end_date' => 'date|required',
        'discounted_total' => 'numeric|required|between:0,999999999.999',
        'active' => 'boolean',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => DiscountPersonEvent::class,
        'updated' => DiscountPersonEvent::class,
        'deleted' => DiscountPersonEvent::class,
    ];
    protected $casts = [
        'id' => 'integer',
        'person_data_id' => 'integer',
        'discount_percentage' => 'decimal:5',
        'active' => 'boolean',
        'status' => 'string',
        'discounted_total' => 'decimal:13',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function getDiscountedTotalAttribute($value)
    {
        return number_format($value, 3);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->toDateTimeString();
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::parse($value)->toDateTimeString();
    }

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function expired()
    {
        $this->active = 0;
        $this->status = 'Not active';
    }
}
