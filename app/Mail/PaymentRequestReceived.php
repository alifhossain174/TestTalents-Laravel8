<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentRequestReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $paymentDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->paymentDetails = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailSubject = "Payment Request Received Successfully";
        return $this->subject($emailSubject)->view('backend.recharge.payment_request_received');
    }
}
