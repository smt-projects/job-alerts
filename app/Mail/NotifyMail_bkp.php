<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
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
    // return $this->view('emails.subscriptionMail');
    return $this->subject("VanderHouwen Job Alert")->view("emails.subscriptionMail");
  }
}
