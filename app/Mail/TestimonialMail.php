<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestimonialMail extends Mailable
{
    use Queueable, SerializesModels;
    public $testimonialInfo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->testimonialInfo = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailSubject = "Request for Testimonial";
        return $this->subject($emailSubject)->view('backend.client.testimonialMail');
    }
}
