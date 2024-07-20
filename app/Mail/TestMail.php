<?php
// app/Mail/TestMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->view('emails.test')
                    ->subject($this->details['title'])
                    ->with([
                        'title' => $this->details['title'],
                        'body' => $this->details['body'],
                    ]);
    }
}
