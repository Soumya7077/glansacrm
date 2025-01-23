<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->view('email.custom_mail')
                    ->subject($this->details['subject'] ?? 'No Subject')
                    ->cc($this->details['cc'] ?? [])
                    ->with('details', $this->details);
    }
}
