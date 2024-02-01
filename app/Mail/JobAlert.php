<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        // dd($details);die();
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject_line = 'VanderHouwen Job Alert for ' . $this->details['label'];
                // 'reply_to'     => 'jobalert@vanderhouwen.com',
                // 'from_name'    => 'VanderHouwen Job Alert',
        // return $this->view('emails.subscriptionMail');
        return $this->subject($subject_line)
                    ->view('emails.jobalertMail')
                    ->with([
                        'label' => $this->details['label'],
                        'mailCont' => $this->details['mailCont'],
                    ]);


    }
}
