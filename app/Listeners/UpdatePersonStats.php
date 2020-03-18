<?php

namespace App\Listeners;

use App\Actions\CalculatePersonStats;
use App\DiscountPersonData;
use App\PersonStats;

class UpdatePersonStats
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function invoice($event)
    {
        $person_data_id = $event->invoice->person_data_id;
        $this->updateStats($person_data_id);
    }

    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function payment($event)
    {
        $person_data_id = $event->payment->person_data_id;
        $this->updateStats($person_data_id);
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\InvoiceEvent',
            'App\Listeners\UpdatePersonStats@invoice'
        );

        $events->listen(
            'App\Events\PaymentEvent',
            'App\Listeners\UpdatePersonStats@payment'
        );
    }

    private function updateStats($id)
    {
        $stats = new CalculatePersonStats();
        $stats->calculateAmounts($id);
        $person_stats = PersonStats::where('person_data_id', $id)->first();
        if (1 == $person_stats->status) { //with personal discount
            $discounted_total = DiscountPersonData::select('discounted_total')
                ->where([
                    ['person_data_id', $id],
                    ['active', 1],
                ])->get();
            $person_stats->personal_amount_due = $discounted_total - $stats->getAmountPaid();
        } elseif (2 == $person_stats->status) {
            $person_stats->amount_due = $stats->amount_due_without_discounts;
        } else {
            $person_stats->amount_due = $stats->amount_due;
        }
        $person_stats->amount_paid = $stats->getAmountPaid();
        $person_stats->save();
    }
}
