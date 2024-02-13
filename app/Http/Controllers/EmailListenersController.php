<?php 
namespace App\Http\Controllers;

use Illuminate\Mail\Events\MessageSent;

class EmailListenersController
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
    * @param  Illuminate\Mail\Events\MessageSent  $event
    * @return void
    */
    public function handle(MessageSent $email)
    {
        $header = $email->message->getHeaders();
        // dd($headers);
        \Log::channel('customerror')->critical($headers);
    }
}
