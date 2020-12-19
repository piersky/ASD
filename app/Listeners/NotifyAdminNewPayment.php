<?php

namespace App\Listeners;

use App\Events\NewPaymentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminNewPayment
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
     * @param  NewPaymentCreated  $event
     * @return void
     */
    public function handle(NewPaymentCreated $event)
    {
        dd($event);
    }
}
