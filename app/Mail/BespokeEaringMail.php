<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BespokeEaringMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
        Log::info('Mail data -> '.json_encode($this->mailData, true));
    }


    public function build()
    {
        return $this->view('mails.bespoke-earing')
        ->with([
            'mailData' => $this->mailData,
        ])
        ->attachFromStorage('public/'.$this->mailData['referenceImagePath'], $this->mailData['originalName']);
    }
}
