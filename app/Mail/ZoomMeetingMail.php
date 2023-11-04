<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ZoomMeetingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $zoomMeetingInfo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->zoomMeetingInfo = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailSubject = "Zoom Meeting Invitation";
        return $this->subject($emailSubject)->view('backend.client.zoomMeetingMail');
    }
}
