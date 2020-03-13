<?php

namespace App\Listeners;

use App\Events\PersonDataCreated;
use App\PersonStats;

class CreatePersonStats
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PersonDataCreated $event)
    {
        $person_data = $event->person_data;
        $stats['person_data_id'] = $person_data->id;
        $stats['status'] = 0;
        $stats['amount_paid'] = 0;
        $stats['amount_due'] = 0;
        PersonStats::create($stats);
    }
}
