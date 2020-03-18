<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonStats extends Model
{
    public $primaryKey = 'person_data_id';
    public $fillable = [
        'status',
        'amount_paid',
        'amount_due',
        'personal_amount_due',
        'total_amount_due',
        'person_data_id',
    ];
    protected $casts = [
        'person_data_id' => 'integer',
        'status' => 'string',
        'amount_paid' => 'decimal:13',
        'amount_due' => 'decimal:13',
        'total_amount_due' => 'decimal:13',
        'personal_amount_due' => 'decimal:13',
    ];

    /**
     * Get the value of amount_due.
     */
    public function getAmount_due()
    {
        return number_format($this->amount_due, 3);
    }

    /**
     * Get the value of personal_amount_due.
     */
    public function getPersonalAmountDue()
    {
        return number_format($this->personal_amount_due, 3);
    }

    public function getTotalAmountDue()
    {
        return number_format($this->total_amount_due, 3);
    }

    /**
     * Get the value of amount_paid.
     */
    public function getAmount_paid()
    {
        return number_format($this->amount_paid, 3);
    }

    public function getTotal()
    {
        if (1 == $this->status) {
            $total = $this->amount_paid + $this->personal_amount_due;

            return number_format($total, 3);
        }

        $total = $this->amount_paid + $this->amount_due;

        return number_format($total, 3);
    }

    public function person_data()
    {
        return $this->belongsTo('App\PersonData');
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 0:
                return 'Insurance discount';

                break;
            case 1:
                return 'Personal discount';

                break;
            case 2:
                return 'No discounts';

                break;
        }
    }
}
