<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use SerializesModels;

    public $token;

    // Constructor to inject the token into the email
    public function __construct($token)
    {
        $this->token = $token;
    }

    // Build the email message
    public function build()
    {
        return $this->subject('Password Reset Request')
                    ->view('email.password_reset')
                    ->with([
                        'token' => $this->token,
                        'url' => url('password/reset/'.$this->token), // Generate the password reset URL
                    ]);
    }
}
