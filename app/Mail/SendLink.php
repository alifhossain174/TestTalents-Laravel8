<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendLink extends Mailable
{
    use Queueable, SerializesModels;
    public $sendLinkInfo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->sendLinkInfo = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $companyName = '';
        if(Auth::user()->company_name){
            $companyName = " at ".Auth::user()->company_name;
        }
        $str = "Invitation to Assessment for Recruitment of ";
        $jobRole = DB::table('assesments')
                        // ->leftJoin('job_roles','assesments.job_role','=','job_roles.id')
                        ->select('assesments.job_role')
                        ->where('assesments.slug',$this->sendLinkInfo['assesment_slug'])
                        ->first();

        $emailSubject = $str.$jobRole->job_role.$companyName;
        return $this->subject($emailSubject)->view('backend.assesment.sendLinkEmail');
    }
}
