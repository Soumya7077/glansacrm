<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class PasswordResetMail extends Mailable
{
  use Queueable, SerializesModels;

  public $resetLink;

  public function __construct($resetLink)
  {
    $this->resetLink = $resetLink;
  }

  public function build()
  {
    return $this->subject('Password Reset Request')
      ->view('email.password_reset')
      ->with(['resetLink' => $this->resetLink]);
  }
}
