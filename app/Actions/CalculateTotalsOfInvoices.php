<?php

namespace App\Actions;

class CalculateTotalsOfInvoices
{
    private $total = 0;
    private $total_with_discounts = 0;
    private $amount_paid = 0;
    private $amount_due = 0;
    private $invoices = [];

    public function __construct($invoices)
    {
        $this->addInvoices($invoices);
    }

    public function addInvoices($invoices)
    {
        $invoices->map(function ($invoice) {
            array_push($this->invoices, $invoice);
        });
    }

    /**
     * Get the value of total.
     */
    public function getTotal()
    {
        return number_format($this->total, 3);
    }

    /**
     * Get the value of total_with_discounts.
     */
    public function getTotal_with_discounts()
    {
        return number_format($this->total_with_discounts, 3);
    }

    /**
     * Get the value of amount_paid.
     */
    public function getAmount_paid()
    {
        return number_format($this->amount_paid, 3);
    }

    /**
     * Get the value of amount_due.
     */
    public function getAmount_due()
    {
        return number_format($this->amount_due, 3);
    }

    public function calculateTotals()
    {
        foreach ($this->invoices as $invoice) {
            $this->total += (float) str_replace(',', '', $invoice->total);
            $this->total_with_discounts += (float) str_replace(',', '', $invoice->total_with_discounts);
            $this->amount_paid += (float) str_replace(',', '', $invoice->amount_paid);
            $this->amount_due += (float) str_replace(',', '', $invoice->amount_due);
        }
    }

    public function getInvoicesCount()
    {
        return count($this->invoices);
    }
}
