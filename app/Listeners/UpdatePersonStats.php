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

    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function discount($event)
    {
        $person_data_id = $event->discount_person->person_data_id;
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

        $events->listen(
            'App\Events\DiscountPersonEvent',
            'App\Listeners\UpdatePersonStats@discount'
        );
    }

    private function updateStats($id)
    {
        $stats = new CalculatePersonStats();
        $stats->calculateAmounts($id);
        $person_stats = PersonStats::where('person_data_id', $id)->first();

        if (1 == $person_stats->status) { //with personal discount
            $discount_person = DiscountPersonData::
                where([
                    ['person_data_id', $id],
                    ['active', 1],
                ])->first();
            $person_stats->personal_amount_due =
                (float) str_replace(',', '', $discount_person->discounted_total) - $stats->getAmountPaid();
        } else {
            $person_stats->total_amount_due = $stats->amount_due_without_discounts;
            $person_stats->amount_due = $stats->amount_due;
        }

        $person_stats->amount_paid = $stats->getAmountPaid();
        $person_stats->save();
    }
}
