<?php

namespace App\Listeners;

use App\Events\PaymentEdited;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminEditedPayment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentEdited  $event
     * @return void
     */
    public function handle(PaymentEdited $event)
    {
        //
    }
}
