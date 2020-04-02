<?php

namespace App\Console\Commands;

use App\Actions\CheckDiscountStatus;
use Illuminate\Console\Command;

class CheckPersonalDiscountsDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:discounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update expired personal discounts';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $check = new CheckDiscountStatus();
        $check->verifyStatus();
        $this->info('Personal discounts checked.');
    }
}
