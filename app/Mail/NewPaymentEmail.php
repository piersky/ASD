<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPaymentEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.new_payment_admin');
    }
}
