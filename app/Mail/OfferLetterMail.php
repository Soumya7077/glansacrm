<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class OfferLetterMail extends Mailable
{
    public $details;
    public $offerLetterPath;

    // Constructor to accept email details and the path of the attachment
    public function __construct($details, $offerLetterPath)
    {
        $this->details = $details;
        $this->offerLetterPath = $offerLetterPath;
    }

    public function build()
    {
        return $this->subject('Offer Letter')
                    ->view('email.offer_latter') // Add your email view here
                    ->with('details', $this->details)
                    ->attach(Storage::disk('public')->path($this->offerLetterPath), [
                        'as' => 'offer_letter.pdf', // The file name in the email
                        'mime' => 'application/pdf',
                    ]);
    }
}


