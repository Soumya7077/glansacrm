<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class PasswordResetMail extends Mailable
{
  use Queueable, SerializesModels;

  public $resetLink;

  // Constructor to inject the token into the email
  public function __construct($resetLink)
  {
    $this->resetLink = $resetLink;
  }

  // Build the email message
  public function build()
  {
    return $this->subject('Password Reset Request')
      ->view('email.password_reset', )
      ->with(['resetLink' => $this->resetLink]);
  }
}
