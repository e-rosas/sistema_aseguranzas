<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use SoftDeletes;
    public $insuree;
    public $fillable = [
        'number',
        'comments',
        'status',
        'date',
        'total',
        'total_with_discounts',
        'amount_paid',
        'amount_due',
        'sub_total',
        'tax',
        'person_data_id',
    ];
    public static $rules = [
        'number' => 'required',
        'status' => 'max:255',
        'date' => 'date',
        'comments' => 'max:1000',
        'total' => 'numeric|required|between:0,999999999.999',
        'total_with_discounts' => 'numeric|required|between:0,999999999.999',
        'amount_paid' => 'numeric|between:0,999999999.999',
        'amount_due' => 'numeric|between:0,999999999.999',
        'sub_total' => 'numeric|between:0,999999999.999',
        'tax' => 'numeric|between:0,999999999.999',
        'person_data_id' => 'required',
    ];
    protected $casts = [
        'id' => 'integer',
        'person_data_id' => 'integer',
        'number' => 'string',
        'date' => 'date',
        'comments' => 'string',
        'status' => 'string',
        'total' => 'decimal:13',
        'total_with_discounts' => 'decimal:13',
        'amount_paid' => 'decimal:13',
        'amount_due' => 'decimal:13',
        'sub_total' => 'decimal:13',
        'tax' => 'decimal:13',
    ];

    protected $dates = ['date'];

    public function getTotalAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getTotalWithDiscountsAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getAmountPaidAttribute($value)
    {
        return number_format($value, 3);
    }

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function services()
    {
        return $this->hasMany('App\InvoiceService');
    }

    public function calls()
    {
        return $this->hasMany('App\Call');
    }

    public function discounts()
    {
        return $this->hasMany('App\Discount');
    }

    public function findInsuree()
    {
        $insureeid = DB::table('beneficiaries')->where('person_data_id', $this->person_data_id)->value('insuree_id');
        $this->insuree = Insuree::find($insureeid);

        return $this->insuree->person_data;
    }

    public function findInsurer()
    {
        if (0 == $this->person_data->insured) {
            if (!isset($this->insuree)) {
                $insureeid = DB::table('beneficiaries')->where('person_data_id', $this->person_data_id)->value('insuree_id');
                $this->insuree = Insuree::find($insureeid);
            }

            return $this->insuree->insurer;
        }

        $insurerid = DB::table('insurees')->where('person_data_id', $this->person_data_id)->value('insurer_id');

        return Insurer::find($insurerid);
    }
}
