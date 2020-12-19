<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\NewPaymentCreated' => [
            'App\Listeners\NotifyAdminNewPayment',
            //'Motto\Listeners\NotifyUserNewPayment'
        ],
        'App\Events\PaymentEdited' => [
            'App\Listeners\NotifyAdminEditedPayment'
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogSuccessfulLogin',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
