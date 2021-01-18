<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReaplyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $subjetct;
     public $message;
    public function __construct($subject,$message)
    {
        $this->subject=$subject;
        $this->message=$message;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
         return $this->view('admin.email')->with('data',$this->message)->subject($this->subject);
 
    }
}
