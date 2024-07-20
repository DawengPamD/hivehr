<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invitation; // If necessary, import any models or other dependencies

class CompanyInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        return $this->view('emails.company_invitation')
                    ->subject('You are invited to join a company')
                    ->with([
                        'invitation' => $this->invitation,
                    ]);
    }
}
